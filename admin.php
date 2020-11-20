<?php
$db=mysqli_connect('localhost','root','','moduleconnexion');
$req="SELECT * FROM `utilisateurs`";
$query=mysqli_query($db,$req);
$assoc_results=mysqli_fetch_assoc($query);
$all_results=mysqli_fetch_all($query);
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="moduleconnexion.css">
    <title>Document</title>
</head>
<body>
<header class="navbar">
    <ul class="nav nav-pills nav-fill navul">
        <li class="nav-item">
            <a class="nav-link active" href="index.php">Accueil</a>
        </li>
        <?php
        if(!isset($_SESSION['login'])){
            echo "<li class='nav-item'><a class='nav-link' href='inscription.php'>Inscription</a></li>";
            echo  "<li class='nav-item'>";
            echo "<a class='nav-link' href='connexion.php'>Connexion</a></li>";
        }else{
            echo "<li class='nav-item'><form action='admin.php' method='get'><input class='btn btn-link' type='submit' name='disconnect' value='Déconnexion'></form></li>";
            if(isset($_GET['disconnect'])){
                unset($_SESSION['login']);
                session_destroy();
                header('Location:connexion.php');
            }
        }       ?>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">A propos</a>
        </li>
    </ul>
</header>
<main>

<?php

if(isset($_SESSION['login']) && $_SESSION['login']=="admin"){
    echo "<div class='tablecontainer'><h1>Table des utilisateurs</h1><table class='tableadmin'>";
foreach($assoc_results as $key=>$value){
    echo "<th>".$key."</th>";
}
foreach($all_results as $key=>$values){
    echo "<tr>";
    foreach($values as $key=>$value){
        echo "<td>".$value."</td>";
    }
    echo "</tr>";
}

echo "</table>";
}
else{
    header("Location:index.php");
}
?>
    </table>
</main>
</div>
<footer>
    <ul class="list-group">
        <li class="list-group-item middle"><a href="index.php">Accueil</a></li>
        <?php
        if(!isset($_SESSION['login'])){
            echo "<li class='list-group-item middle'><a href='connexion.php'>Connexion</a></li><li class='list-group-item middle'><a href='inscription.php'>Inscrivez-vous</a></li>";

        }else{
            echo "<li class='list-group-item middle paddng'><form action='admin.php' method='get'><input class='btn btn-link' type='submit' name='disconnect' value='Déconnexion'></form></li>";
            if(isset($_GET['disconnect'])){
                unset($_SESSION['login']);
                session_destroy();
                header('Location:connexion.php');
            }
        }
        ?>
        <li class="list-group-item middle"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">A propos</a>   </li>
    </ul>

</footer>

</body>
</html>
