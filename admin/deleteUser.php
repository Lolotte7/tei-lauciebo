<?php
    session_start();
    // si la session n'existe pas, redirection vers formulaire
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }

     // tester si il y a le get id dans l'URL
     if(!isset($_GET['id']))
     {
         header("LOCATION:work.php");
     }
     require "../connexion.php";
 
     // récup les données qui corresponde à l'id
     $id = htmlspecialchars($_GET['id']);
 
 
     $req = $bdd->prepare("SELECT * FROM admin WHERE id=?");
     $req->execute([$id]);
     // tester s'il existe dans la bdd
     if(!$don = $req->fetch())
     {
         $req->closeCursor();
         header("LOCATION:user.php");
     }
     $req->closeCursor();


     if(isset($_GET['del']))
     { 
         $delete = $bdd->prepare("DELETE FROM admin WHERE id=?");
         $delete->execute([$id]);
         $delete->closeCursor();
         header("LOCATION:user.php?delete=success&id=".$id);
     }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="styleAdmin.css">
    <title>Administration</title>
</head>
<body>
<div class="container-fluid">
    <h1>Administration de lauciebo</h1>
    <h3>Bonjour <?php echo $_SESSION['login'] ?></h3>
    <a href="dashboard.php?deco=ok" class="btn btn-danger my-1">Déconnexion</a>
    <div class="row">
        <div class="col-4">
            <a href="work.php" class="btn btn-secondary my-1">Retour</a><br>
        </div>
    </div>
</div>
<div class="container">
    <div class="info-user">
     <span class="title-user">Login: </span>
     <div class="value-user"><?= $don['login'] ?></div>
    </div>
    <div class="info-user">
     <span class="title-user">Adresse E-mail: </span>
     <div class="value-user"><?= $don['email'] ?></div>
    </div>

    <h2>Voulez-vous supprimer <?= $don['login'] ?></h2>
    <a href="user.php" class="btn btn-success mx-2">Non</a>
    <a href="deleteUser.php?id=<?= $don['id'] ?>&del=ok" class="btn btn-danger mx-2">Oui</a>
    
</div>

</body>
</html>