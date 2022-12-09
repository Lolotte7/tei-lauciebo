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
         header("LOCATION:skills.php");
     }
     require "../connexion.php";
 
     // récup les données qui corresponde à l'id
     $id = htmlspecialchars($_GET['id']);
 
 
     $req = $bdd->prepare("SELECT * FROM competence WHERE id=?");
     $req->execute([$id]);
     // tester s'il existe dans la bdd
     if(!$don = $req->fetch())
     {
         $req->closeCursor();
         header("LOCATION:skills.php");
     }
     $req->closeCursor();


     if(isset($_GET['del']))
     {
         unlink("../upload/".$don['image']);
         if(!empty($don['pdf']))
         {
             unlink("../upload/".$don['pdf']);
         }
         $delete = $bdd->prepare("DELETE FROM competence WHERE id=?");
         $delete->execute([$id]);
         $delete->closeCursor();
         header("LOCATION:skills.php?delete=success&id=".$id);
     }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
    <title>Administration</title>
</head>
<body>

<div class="container-fluid">
    <h1>Administration de lauciebo</h1>
    <h3>Bonjour <?php echo $_SESSION['login'] ?></h3>
    <a href="dashboard.php?deco=ok" class="btn btn-danger my-1">Déconnexion</a>
    <div class="row">
        <div class="col-4">
            <a href="works.php" class="btn btn-secondary my-1">Retour</a><br>
        </div>
    </div>
</div>

<div class="container">
     <div class="info-skills">
        <img src="../upload/<?= $don['image'] ?>" alt="image de <?= $don['titre'] ?>">
     </div>
    <div class="info-skills">
     <span class="label-skills">Compétence: </span>
     <span class="value-skills"><?= $don['titre'] ?></span>
    </div>
    
    <?php
        if(!empty($don['pdf']))
        {
            echo ' <span class="label-artwork">Document: </span>';
            echo "<a href='../upload/".$don['pdf']."'>Document</a>";
        }
    ?>

    <h2>Voulez-vous supprimer <?= $don['titre'] ?></h2>
    <a href="skills.php" class="btn btn-success mx-2">Non</a>
    <a href="deleteSkills.php?id=<?= $don['id'] ?>&del=ok" class="btn btn-danger mx-2">Oui</a>
    
</div>
</body>
</html>