<?php
    session_start();
     // si la session n'existe pas, redirection vers formulaire de connexion
     if(!isset($_SESSION['login']))
     {
         header("LOCATION:../index.php");
     }
     // tester si est envoyé 
     if(isset($_POST['name']))
     {
        $err=0;
        $name = htmlspecialchars($_POST['name']);

       
        if(empty($_POST['email'])) 
        {
            $err=1;
        }else{
            $email = htmlspecialchars($_POST['email']);
        }
      
        if(empty($_POST['subject'])) 
        {
            $err=2;
        }else{
            $subject = htmlspecialchars($_POST['subject']);
        }

        if(empty($_POST['message'])) 
        {
            $err=3;
        }else{
            $message = $_POST['message'];
        }
        
      
        if($err===0)
        {
               
                require "../connexion.php";
                $insert = $bdd->prepare("INSERT INTO contact (name,email,subject,message) VALUES(:name,:email,:subject,:message)");
                $insert->execute([
                    ":name" => $name,
                    ":email" => $email,
                    ":subject" => $subject,
                    ":message" => $message,
                    
                ]);
                $insert->closeCursor();
                // redirection vers oeuvres.php avec message success 
                header("LOCATION:../index.php?success");
            }else{
                header("LOCATION:../index.php?error=".$err."");
                
            }   

    
        }else{

            // renvoyer l'utilisateur vers le formulaire avec l'info de l'erreur
            header("LOCATION:../index.php?error=".$err);
        }
     
     
?>