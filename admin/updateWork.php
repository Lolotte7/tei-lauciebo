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
  
  
      $req = $bdd->prepare("SELECT * FROM portfolio WHERE id=?");
      $req->execute([$id]);
      // tester s'il existe dans la bdd
      if(!$don = $req->fetch())
      {
          $req->closeCursor();
          header("LOCATION:work.php");
      }
      $req->closeCursor();

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
    <h1 class="mb-3">Modifier <?= $don['titre'] ?></h1>
      <form action="treatmentUpdateWork.php?id=<?= $don['id'] ?>" method="POST" enctype="multipart/form-data">
        <?php
            if(isset($_GET['error']))
            {
                echo "<div class='alert alert-danger'>Veuillez remplir le formulaire correctement (code erreur : ".$_GET['error']." )</div>";
            }

            if(isset($_GET['imgerror']))
            {
                echo "<div class='alert alert-danger'>Le fichier envoyé a eu problème (code erreur : ".$_GET['imgerror']." )</div>";
            }
            if(isset($_GET['fileerror']))
            {
                echo "<div class='alert alert-danger'>Le fichier envoyé a eu problème (code erreur : ".$_GET['fileerror']." )</div>";
            }
            if(isset($_GET['upload']))
            {
                echo "<div class='alert alert-danger'>Le transfert du fichier a eu problème</div>";
            }

        ?>
        <div class="form-group mb-3">
            <label for="titre">Titre: </label>
            <input type="text" id="titre" name="titre" class="form-control" placeholder="Titre de l'oeuvre" value="<?= $don['titre'] ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="categorie">Catégorie</label>
            <select name="categorie" id="categorie" class="form-control">
                <?php
                    if($don['categorie']=="broderie")
                    {
                        echo '<option value="broderie"selected>broderie</option>';
                        echo '<option value="flocage">flocage</option>';
                        echo '<option value="impression">impression</option>';
        
                    }elseif($don['categorie']=="flocage")
                       {  
                        echo '<option value="broderie" >broderie</option>';
                        echo '<option value="flocage"selected>flocage</option>';
                        echo '<option value="impression">impression</option>';

                    }elseif($don['categorie']=="impression")
                    {
                        echo '<option value="broderie" >broderie</option>';
                        echo '<option value="flocage">flocage</option>';
                        echo '<option value="impression"selected>impression</option>';
                    }
                        
                ?>
            </select>
        </div>
        <div class="form-group  mb-3">
            <label for="description">description</label>
            <textarea name="description" id="description" class="form-control"><?= $don['description'] ?></textarea>
        </div>
        <div class="col-12">
            <img src="../upload/<?= $don['image'] ?>" class="img-demo" alt="image de <?= $don['titre'] ?>">
        </div>
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02" name="image">
            <label class="input-group-text" for="inputGroupFile02">Image</label>
        </div>
        <?php
            if(!empty($don['pdf']))
            {
                echo '<div class="col-12">';
                    echo ' <span class="label-artwork">Document: </span>';
                    echo "<a href='../upload/".$don['pdf']."'>Document</a>";
                echo '</div>';
            }
        ?>
         <!-- pour le PDF -->
         <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02" name="pdf">
            <label class="input-group-text" for="inputGroupFile02">PDF (facultatif)</label>
        </div>
        <div class="form-group">
            <input type="submit" value="Modifier" class="btn btn-warning">
        </div>
      </form>
</div>

</body>
</html>