<?php
$db=mysqli_connect('localhost','root','L@Platef0rme','moduleconnexion');
$req="SELECT * FROM `utilisateurs` WHERE `id`={$_COOKIE['id']}";
$query=mysqli_query($db,$req);
$all_results=mysqli_fetch_assoc($query);
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
            echo "<li class='nav-item'><form action='profil.php' method='get'><input class='btn btn-link' type='submit' name='disconnect' value='Déconnexion'></form></li>";
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
    <form action="profil.php" method="get" class="moduleform">
        <fieldset class="formfieldset">
    <?php
    foreach($_SESSION as $key=>$value){
    if($key!=="id"){
        echo "<label for=".$key.">".ucfirst($key)."</label>";
        echo "<input type='text' id=".$key." name=".$key." value=".$value.">";
    }
    }
    echo " <input type='submit' class='btn btn-primary btn2' name='submit'value='Submit'>";
    echo " <input type='submit' class='btn btn-primary btn2' name='disconnect'value='Deconnecte-Moi'>";
    if(isset($_GET['submit'])){
        foreach($_GET as $key=>$value){
            if($key=="login"){
                $login=$value;
            }
            if($key=="nom"){
                $nom=$value;
            }
            if($key=="prenom"){
                $prenom=$value;
            }
            if($key=="password"){
                $password=$value;
            }
        }
    $req2="SELECT * FROM `utilisateurs`";
    $query2=mysqli_query($db,$req2);
    $all_results=mysqli_fetch_all($query2);
    $signal = 0;
    for($i=0;isset($all_results[$i]);$i++){
        if($all_results[$i][1]==$login && $login!=$_SESSION['login']){
            echo "Ce nom d'utilisateur existe deja";
            $signal=1;
        }
    }
    if ($signal==0){
        $req3="UPDATE `utilisateurs` SET `login`='{$login}',`nom`='{$nom}',`prenom`='{$prenom}',`password`='{$password}' WHERE `login`='{$_SESSION['login']}'";
        $query3=mysqli_query($db,$req3);
        unset($_COOKIE['id']);
    }
    }
    if(isset($_GET['disconnect'])){
        session_destroy();
        header('Location:connexion.php');
    }
    ?>
        </fieldset>
    </form>

</main>
<footer>
    <ul class="list-group">
        <li class="list-group-item middle"><a href="index.php">Accueil</a></li>
        <?php
        if(!isset($_SESSION['login'])){
            echo "<li class='list-group-item middle'><a href='connexion.php'>Connexion</a></li><li class='list-group-item middle'><a href='inscription.php'>Inscrivez-vous</a></li>";

        }else{
            echo "<li class='list-group-item middle paddng'><form action='profil.php' method='get'><input class='btn btn-link' type='submit' name='disconnect' value='Déconnexion'></form></li>";
            if(isset($_GET['disconnect'])){
                unset($_SESSION['login']);
                session_destroy();
                header('Location:connexion.php');
            }
        }       ?>
        <li class="list-group-item middle"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">A propos</a>   </li>
    </ul>

</footer>

</body>
</html>
