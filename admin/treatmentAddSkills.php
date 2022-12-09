<?php
    session_start();
     // si la session n'existe pas, redirection vers formulaire de connexion
     if(!isset($_SESSION['login']))
     {
         header("LOCATION:index.php");
     }
     // tester si le formulaire est envoyé 
     if(isset($_POST['titre']))
     {
        $err=0;
       

        //traitement des valeurs 
        if(empty($_POST['titre'])) //   if($_POST['title']=="")
        {
            $err=1;
        }else{
            $titre = htmlspecialchars($_POST['titre']);
        }
      
        
        
      
        if($err===0)
        {
            // traitement de l'image
            $dossier = "../upload/";
            $fichier = basename($_FILES["image"]["name"]);
            $tailleMax = 200000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = ['.png', '.jpg', '.jpeg', '.gif', '.svg'];
            $extension = strrchr($_FILES['image']['name'],'.');
            /* tester l'extension du fichier en comparaison du tableau $extensions */
            /* in_array permet de savoir si le 1er paramètre se retrouve dans le 2ème paramètre qui doit être un tableau */
            if(!in_array($extension, $extensions))
            {
                $imageError = "wrong-extension";
            }
            if($taille > $tailleMax)
            {
                $imageError = "size";
            }
            /* si $imageError n'existe pas  */
            if(!isset($imageError))
            {
                // traitement et formatage du nom du fichier envoyé
                $fichier = strtr($fichier, 
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                // remplacer les caractères spéciaux autre que les lettres en - (REGEX)
                $fichier = preg_replace('/([^.a-z0-9]+)/i','-',$fichier);
                // traitement des fichiers doublons
                $fichiercpt = rand().$fichier;
                // déplacement du fichier temporaire dans le dossier 'upload' avec son nouveau nom 
                if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier.$fichiercpt))
                {
                    // le fichier est dans le dossier
                    // insertion dans la base de données
                    require "../connexion.php";


                    $insert = $bdd->prepare("INSERT INTO competence(titre,image) VALUES(:titre,:image)");
                    $insert->execute([
                        ":titre" => $titre,
                        ":image" => $fichiercpt
                        
                    ]);
                    $insert->closeCursor();
                    // redirection vers oeuvres.php avec message success 
                    header("LOCATION:skills.php?add=success");
                }else{
                    header("LOCATION:addSkills.php?upload=error");
                }


            }else{
                header("LOCATION:addSkills.php?imgerror=".$imageError);
            }






            // insertion dans la bdd 
        }else{

            // renvoyer l'utilisateur vers le formulaire avec l'info de l'erreur
            header("LOCATION:addSkills.php?error=".$err);
        }
     }else{
         header('LOCATION:addSkills.php');
     }
     
?>