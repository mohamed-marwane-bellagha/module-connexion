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
        <li class="nav-item">
            <a class="nav-link" href="inscription.php">Inscription</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="connexion.php">Connexion</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">A propos</a>
        </li>
    </ul>
</header>
<main>

    <form action="connexion.php" method="get" class="moduleform">
        <fieldset class="formfieldset">
            <div class="form-group">
                <label for="exampleInputEmail1">Login</label>
                <input type="text" class="form-control" id="login" name="login" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <input type="submit" class="btn btn-primary" name="submit"value="Submit">
            <?php
            $db=mysqli_connect('localhost','root','L@Platef0rme','moduleconnexion');
            $req="SELECT * FROM `utilisateurs`";
            $query=mysqli_query($db,$req);
            $all_results=mysqli_fetch_all($query);

            foreach($_GET as $key=>$value){
                if($key=="login"){
                    $login=$value;
                }
                if($key=="password"){
                    $password=$value;
                }
            }
            if(isset($_GET['submit'])){
                if ($all_results[0][1]==$login && $all_results[0][4]){
                    header('Location:admin.php');
                }
                for($i=1;isset($all_results[$i]);$i++){
                    if($all_results[$i][1]==$login && $all_results[$i][4]==$password){
                        session_start();
                        header('Location:profil.php');
                        $_SESSION['login']=$login;
                        $_SESSION['nom']=$all_results[$i][2];
                        $_SESSION['prenom']=$all_results[$i][3];
                        $_SESSION['password']=$password;
                        var_dump($_SESSION['login']);
                    }
                    else{
                        echo "Rentrez des informations correctes";
                    }

                }
            }

            ?>
        </fieldset>
    </form>
</main>
<footer>
    <ul class="list-group">
        <li class="list-group-item middle"><a href="index.php">Accueil</a></li>
        <li class="list-group-item middle"><a href="connexion.php">Connexion</a></li>
        <li class="list-group-item middle"><a href="inscription.php>">Inscrivez-vous</a></li>
        <li class="list-group-item middle"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">A propos</a>   </li>
    </ul>

</footer>

</body>
</html>
