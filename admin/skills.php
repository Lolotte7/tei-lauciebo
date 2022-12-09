<?php
    session_start();
    // si la session n'existe pas, redirection vers formulaire de connexion
    if(!isset($_SESSION['login']))
    {
        header("LOCATION:index.php");
    }
    require "../connexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compétences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
</head>
<body>

<div class="container-fluid contenu">
    <h1>Administration de lauciebo</h1>
    <h3>Gestion des compétences</h3>
    <h3>Bonjour <?php echo $_SESSION['login'] ?></h3>
    <a href="dashboard.php?deco=ok" class="btn btn-danger my-1">Déconnexion</a>
    <div class="row">
        <div class="col-12">
            <a href="dashboard.php" class="btn btn-secondary my-1">Retour</a><br>
            
        </div>
    </div>
    <div class="container">
        <?php
            if(isset($_GET['add']))
            {
                echo "<div class='alert alert-success'>Votre compétence a bien été enregistrée</div>"; 
            }
            if(isset($_GET['delete']))
            {
                echo "<div class='alert alert-danger'>La compétence id : ".$_GET['id']." a bien été supprimée</div>"; 
            }
            if(isset($_GET['update']))
            {
                echo "<div class='alert alert-warning'>La compétence id : ".$_GET['id']." a bien été modifiée</div>"; 
            }
        ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class='text-center'>Id</th>
                    <th class='text-center'>Compétence</th>
                    <th class='text-center'>Logo</th>
                    <th class=text-center>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $req = $bdd->query("SELECT * FROM competence");

                    $req = $bdd->query("SELECT * FROM competence");

                    while($don = $req->fetch())
                    {
                        echo "<tr>";
                            echo "<td class='text-center'>".$don['id']."</td>";
                            echo "<td class='text-center'>".$don['titre']."</td>";
                            echo "<td class='text-center'>".$don['image']."</td>";

                            echo "<td class='text-center'>";
                                
                               
                                echo "<a href='deleteSkills.php?id=".$don['id']."' class='btn btn-danger mx-2'>Supprimer</a>";
                            echo "</td>";
                        echo "</tr>";
                    }
                    $req->closeCursor();
                ?>
            </tbody>
        </table>
        <div class="form-group">
        <a href="addSkills.php" class="btn btn-success">Ajouter</a>
        </div>
</div>

</div>
</body>
</html>