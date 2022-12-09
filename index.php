<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <script >
        window.addEventListener("load",()=>{
        /*ouvrir fermer menu*/
            const burger=document.querySelector("#burger")
            const menu=document.querySelector("#menu-mobile")
            console.log("menu")
            burger.addEventListener("click",()=>{
                menu.classList.add("menuON");
                
            })
           
            const croix = document.querySelector(".croix")
            croix.addEventListener("click",()=>{
                menu.classList.remove("menuON");
                burger.innerHTML="Menu"
            })


/*lien menu*/
            const linksh = document.querySelectorAll("#menuresponsive ul li a")
           

            linksh.forEach(link => {
                link.addEventListener('click',()=>{
                    menu.classList.remove("menuON");
                })
            })
        
        })
    </script>
</head>
<body>
    <header id="menu-pc">
        <div id="logo">
            <img src="images/grandlogo.png" alt="">
        </div>
        <nav> 
            <ul>
                <li><a href="#home">Accueil</a></li>
                <li><a href="#quisommesnous">Qui sommes-nous?</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#projets">Projets</a></li>
                <li><a href="#tarifs">Tarifs</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <header id="mobile">
        <div id="burger">Menu</div>
    </header>
    <div id="menu-mobile" class="slide">
        <div class="croix">
            <div class="barre" id="barre1"></div>
            <div class="barre" id="barre2"></div>
          
        </div>
    <nav id="menuresponsive">
        <ul>
        <li><a href="#home">Accueil</a></li>
            <li><a href="#quisommesnous">Qui sommes-nous?</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#projets">Projets</a></li>
            <li><a href="#tarifs">Tarifs</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>
</div>


    <div class="slide" id="home">
        <div class="container">
            <img src="images/PETITLOGO TEXTEBLANC.png" alt="">      
        </div>
    </div>


    <div class="slide" id="quisommesnous">
       
       <div class="container"id="groupe">
               <div class="gauche">
                
                   <div id="nous">
                       <h1>Qui sommes-nous?</h1> 
                    
                       <img id="deux"src="images/Groupphotonous.png" alt="Photo de Laurence Bastenier et Michael Bodden">
                       
                     
                       <p>
                       </p>
                       <p>
                          <strong>Pourquoi Laucie Bô?</strong> 
                       </p>
                       <p>
                          C'est arrivé naturellement.
                           Lui c'est <strong>Michaël</strong>, elle c'est <strong>Laurence</strong>, un duo dans la vie mais aussi dans <strong>Laucie Bô</strong>
                          Un suptil mélange de nos filles <strong>LAU</strong>ra et lu<strong>CIE BÔ</strong>dden
                       </p>
                   </div>
               </div>
               <div class="droite">
                   <div id="description"> 
                       <div id="logoNous">
           </div>

                         <p>Spécialisé dans la personnalisation textile, <strong>Laucie Bô</strong> vous accompagne dans vos projets, qu’ils soient juste pour le fun, pour une pièce unique ou pour dévolopper votre image de marque, <strong>nous vous aiderons.</strong></p>   

                        <p>Nous commandons pour vous vos textiles ou vous nous les fournissez pas de souci.</p>

                        <p>Nous vous proposons <strong>la personnalisation</strong> qui vous conviendra selon <strong>vos besoins et votre budget.</strong></p> 

                        <p>Nous vous proposons trois techniques différentes:</p>  
                        <p> <strong>  > le flocage, </p>
                        <p>  > la broderie </p>
                        <p> > et l’impression DTG.</strong> </p> 
                   </div>
               </div>
           </div>    
       </div>
   </div>

<div class="slide" id="services"></div>
















    <div class="slide" id="contact">
            <div class="container">
                <div class="grid-container">
                    <div class="gauche">
                        <div id="info">
                            <div id="petitlogo">
                                <img src="PETITLOGO.png" alt="logo ">
                            </div>
                            <h1>Contact</h1>
                            <div id="coordonnees">
                                <h4>LAUCIE BÔ</h4>
                                <p>47 rue Clerbois</P>
                                <P>7060 Soignies</p>
                                <p>0495 46 25 61</p>
                                <p>067 68 58 45</p>
                                <p>lobastenier@hotmail.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="droite">
                        <div class="container-form">
                            <h2>contact</h2>
                            
                            <form id="contact"  method="POST" action="treatmentAddMessage.php">
        
                                <div class="form-group">
                                    <input type="text" id="nom" value="" name="nom" placeholder="Votre Nom " class="form-control">
                                </div>
                            
                                <div class="form-group">
                                    <input type="email" id="mail" value="" name="email" placeholder="Votre adresse E-mail" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="text" id="demande" value="" name="demande" placeholder="Votredemande " class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <textarea name="demande" id="com" cols="25" rows="10" placeholder="Votre message" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="ENVOYER">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    <footer>
        <div class="container">
            <div class="grid-container">
                <div class="reseaux">
                    <p>réseaux sociaux</p>
                    <a href="https://www.facebook.com/laurence.bastenier/"> <i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/laurencebastenier/"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="legalite">
                    <p>copyright 2022 BASTENIER Laurence</p> 
                </div>
            </div>
        </div>
           
    </footer>
</body>
</html>