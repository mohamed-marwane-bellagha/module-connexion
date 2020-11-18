<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
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
    <form action="inscription.php" method="post" class="moduleform">
        <fieldset class="formfieldset">
        <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input type="text" class="form-control" id="login" name="login" aria-describedby="emailHelp" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Prenom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" aria-describedby="emailHelp" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" aria-describedby="emailHelp" required>

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"> Confirm Password</label>
            <input type="password" class="form-control" id="password2" name="password2" required>
        </div>
        <input type="submit" class="btn btn-primary" name="submit"value="Submit">
            <?php


            foreach($_POST as $key=>$value){
                if($key=="login"){
                    $login=$value;

                }
                if($key=="prenom"){
                    $prenom=$value;
                }
                if($key=="nom"){
                    $nom=$value;
                }
                if($key=="password"){
                    $password=$value;
                }
                if($key=="password2"){
                    $password2=$value;
                }
            }
            if(isset($_POST['submit'])){
            $db=mysqli_connect('localhost','root','L@Platef0rme','moduleconnexion');
            $req2="SELECT * FROM `utilisateurs`";
            $query2=mysqli_query($db,$req2);
            $all_results=mysqli_fetch_all($query2);
            $signal = 0;
                for($i=0;isset($all_results[$i]);$i++){
                    if($all_results[$i][1]==$login){
                    echo "Cet utilisateur existe déjà";
                    $signal=1;
                    }elseif($password!=$password2){
                    echo "Les mots de passe ne correspondent pas";
                        $signal=1;
                        break;

                    }
                }
            if ($signal==0){
                    header("Location:connexion.php");
                    $req="INSERT INTO `utilisateurs`(`login`, `prenom`, `nom`, `password`) VALUES ('{$login}','{$prenom}','{$nom}',
'{$password}')";
                    $query=mysqli_query($db,$req);
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
