<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="image/logo_adidas_100px.png" type="image/x-icon">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://kit.fontawesome.com/fb3e250c04.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>Design</title>
    </head>
    <body>
        <div class="struc">

            <div class="bloc1">
            <?php
            // PAs d'autres solution que cette méthode pour récupérer le panier de l'utilisateur 
            if(Auth::check()){
                $bdd = new PDO('mysql:host=localhost;dbname=design;charset=utf8', 'root', 'root');
                $reponse = $bdd->prepare("CALL RecupPanier(:P_user);");
    
                $reponse->execute(array(':P_user' => Auth::id()));
                $i=0;
			
                while($donnees = $reponse->fetch()){
                    $listPanier[$i] = $donnees["id_produit"];
                    $i = $i+1;
                }
                $reponse->closeCursor();
            
            ?>
                <div class="cart">
                    <a href="/panier"><img class="cart-logo" src="svg/shopping-bag.svg" alt="cart">
                        <span class="notif-article"><?php echo($i);?></span>
                    </a>
                </div>
            <?php
                }
            ?>

                <div class="logo">
                    <img src="image/logo_adidas_100px.png" alt="logo Adidas">
                </div> 

                <nav>
                    <ul>
                        <li><a href="#">mens</a></li>
                        <li><a href="#">womens</a></li>
                        <li><a href="#">kids</a></li>
                        <li><a href="#">other</a></li>
                    </ul>
                </nav>

                <div class="slideshow-container">
                    
                    <?php
                        for ($i=1; $i < 4; $i++) { 
                            echo('<div class="mySlides fade">
                            <img src="image/'.$dataProduit->url_produit.'_'.$i.'.png">
                        </div>');
                        }
                    ?>
                </div>
                <br>

                <!-- Little points -->
                <div class="three-points">
                    <i class="fas fa-circle" onclick="currentSlide(1)"></i>
                    <i class="fas fa-circle" onclick="currentSlide(2)"></i>
                    <i class="fas fa-circle" onclick="currentSlide(3)"></i>
                </div>
            </div>

            <div class="bloc2">
                <div class="top-part">
                    <div class="search-box">
                        <form action="post">
                            <input class="search-text" type="text" placeholder="Search">
                            <a href="#"><i class="fas fa-search"></i></a>
                        </form>
                    </div>
                <?php
                
                    if (!(Auth::check())) {
                ?>
                    <div class="log">
                        <p>No account yet ? <a href="/register">Sign-up</a></p>
                        <p>Else <a href="/login">Log In</a></p>
                    </div>
                <?php
                    }
                    else{
                        ?>
                    <div class="log">
                        <p><a href="/logout">Disconnect</a></p><br>
                        <p>Bonjour <?php echo(Auth::user()->prenom);?></p>
                        <!-- <?php echo e($dataProduit->nom_produit); ?> ----! THIS IS THE METHOD TO TAKE DATAS--> 
                    </div>
                        <?php
                    }
                ?>
                </div>

                <div class="product-description">
                    <div class="product-name">
                        <!-- <h1>Adidas am4 vit.01</h1> -->
                        <h1><?php echo e($dataProduit->nom_produit); ?></h1>
                    </div>
                    <div class="product-ref">
                        <p>Special Edition</p>
                    </div>
                    <div class="product-size">
                        <select class="size">
                            <option id="default_size" value="0">Size :</option>
                            <option value="37">37</option>
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="40">41</option>
                            <option value="40">42</option>
                            <option value="40">43</option>
                        </select>
                    </div>
                    <div class="product-qty">
                        <select class="qty">
                            <option id="default_qty" value="0">Amount :</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <?php
                    if(Auth::check()){
                        ?>
                    <div class="product-buy">
                        <a id="add_cart" href="">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Add To Cart
                        </a>
                    </div>
                    <?php
                    }
                    ?>

                    <?php
                        $qty = $dataProduit->quantite_produit;
                        // $qty=3;
                        // $qty=0;
                        if($qty>5){
                    ?>
                    <div class="product-availability"><p>Availability : </p><span class="dot-stock green-dot"></span> In Stock</div>
                    <?php
                        }
                        elseif ($qty>=1) {
                    ?>
                    <div class="product-availability"><p>Availability : </p><span><span class="dot-stock orange-dot"></span> Limited Amount</span></div>
                    <?php   
                        }
                        else{
                    ?>
                    <div class="product-availability"><p>Availability : </p><span><span class="dot-stock red-dot"></span> Stock Shortage</span></div>
                    <?php
                        }
                    ?>
                </div>  
            </div>
        </div>
        <!-- <footer>
            <div class="one"></div>
            <div class="two"></div>
            <div class="three"></div>
        </footer> -->
        <!-- A REFLECHIR -->

    </body>
    <script language="javascript">
        $(document).ready(function(){
            $(".qty").click(function(){
                $("#default_qty").attr('disabled', '');
            });
            
            $(".size").click(function(){
                $("#default_size").attr('disabled', '');
            });

            $("#add_cart").click(function(e){
				e.preventDefault();
                <?php
                    if(Auth::check()){
                ?>
				$idProduit = <?php echo e($dataProduit->id_produit); ?>;
				$idUser = <?php echo(Auth::id());?>;
				$idAction = 0; /*0 = Ajouter au panier | 1 = suppresion | 2 = Valider commande*/
				$.ajax({
					url: '/send-data',
					type: 'GET',
					data: { id_produit: $idProduit, id_user: $idUser, id_action: $idAction },

					dataType : 'html',
					success : function(code_html, statut){
					   alert('Produit ajouté au panier');
                       document.location.reload(true);
				   },

				   error : function(resultat, statut, erreur){
						console.log("statut");
						console.log("erreur");
						
				   },

				   complete : function(resultat, statut){

				   }

				});
                <?php
                    }
                ?>
			});
        });
/* Le retour de la valeur par défaut de la taille et de la quantité est impossible
Soit "Size :" et  "Amount :"*/

        var slideIndex = 1;
        showSlides(slideIndex);

        // Thumbnail image controls
        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        // for (i = 0; i < dots.length; i++) {
        //     dots[i].className = dots[i].className.replace(" active", "");
        // }
        slides[slideIndex-1].style.display = "block";
        // dots[slideIndex-1].className += " active";
        }
    </script>
</html><?php /**PATH Z:\laragon\www\Design\resources\views/accueil.blade.php ENDPATH**/ ?>