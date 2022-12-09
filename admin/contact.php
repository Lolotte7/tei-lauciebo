<?php
    session_start();

    // verification si je suis en session ou non (à faire)

    require "../connexion.php";

    if(isset($_GET['delete']))
    {
        $reqDelete = $bdd->prepare("SELECT * FROM contact WHERE id=?");
        $reqDelete->execute([$_GET['delete']]);
        if(!$donDelete=$reqDelete->fetch())
        {
            $reqDelete->closeCursor();
            header("LOCATION:contact.php?flash=delete-error&id=".$_GET['delete']);
        }else{
            $reqDelete->closeCursor();

            $delete = $bdd->prepare("DELETE FROM contact WHERE id=?");
            $delete->execute([$_GET['delete']]);
            $delete->closeCursor();
            header("LOCATION:contact.php?flash=delete-success&id=".$_GET['delete']);
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css" >
    <title>Document</title>
</head>
<body>
<div class="row">
        <div class="col-12">
            <a href="dashboard.php" class="btn btn-secondary my-1">Retour</a><br>
            
        </div>
    </div>
    <div class="container">
        <h2>Gestion des contacts</h2>
        <?php
            if(isset($_GET['flash']))
            {
                if($_GET['flash']=="delete-error")
                {
                    echo '<div class="alert alert-danger">Le message id '.$_GET['id'].' ne peut pas être supprimé</div>';
                }elseif($_GET['flash']=="delete-success")
                {
                    echo '<div class="alert alert-success">Le message id '.$_GET['id'].' a bien été supprimé</div>';
                }else{
                    echo '<div class="alert alert-danger">error</div>';
                }
            }

        ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>email</th>
                    <th>date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $contacts = $bdd->query("SELECT id,mail, DATE_FORMAT(date,'%d / %m / %Y %Hh%i') AS mydate FROM contact ORDER BY date DESC");
                while($messages = $contacts->fetch())
                {
                    echo "<tr>";
                        echo "<td>".$messages['id']."</td>";
                        echo "<td><a href='message.php?id=".$messages['id']."'>".$messages['mail']."</a></td>";
                        echo "<td>".$messages['mydate']."</td>";
                        echo "<td><a href='contact.php?delete=".$messages['id']."' class='btn btn-danger'>Supprimer</a></td>";
                    echo "</tr>";
                }
                $contacts->closeCursor();

            ?>
               
                  
            </tbody>
        </table>
    </div>
</body>
</html>