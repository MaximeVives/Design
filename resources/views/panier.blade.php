<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="image/logo_adidas_100px.png" type="image/x-icon">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/cart.css">
        <script src="https://kit.fontawesome.com/fb3e250c04.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>Design-Cart</title>
    </head>
    <body>
        <?php
            if (!(Auth::check())) {
                header('Location: /');
  			    exit();
            }

            else {
                ?>
        <div class="cart-bloc">

            <div class="cart">
                <a href="/"><img class="cart-logo" src="svg/home.svg" alt="cart"></a>
            </div>

            <div class="logo">
                <img src="image/logo_adidas_100px.png" alt="logo Adidas">
            </div> 

            <div class="list-cart">
                    <?php
                    $bdd = new PDO('mysql:host=localhost;dbname=design;charset=utf8', 'root', 'root');
                    $reponse = $bdd->prepare("CALL LinkPanierProduit(:P_user);");
        
                    $reponse->execute(array(':P_user' => Auth::id()));
                    $i=0;
                    $total=0;

                    if (empty($donnees=$reponse->fetch())) {
                        echo('<p style="text-align: center; font-size: 25px;">Vous n\'avez rien dans votre panier !</p>');
                    }
                    else {

                        do{
                            $idProd[$i] = $donnees["id_produit"];
                            $nomProd[$i] = $donnees["nom_produit"];
                            $prixProd[$i] = $donnees["prix_produit"];
                            $imgProd[$i] = $donnees["url_produit"];
                            $idPanier[$i] = $donnees["id_panier"];

                            $total = $total + $donnees['prix_produit'];

                            ?>
                            <div class="list-cart-item">
                                <?php echo('<img class="icon-descr" src="image/'.$imgProd[$i].'_1_ico.png" alt="">');?>
                                <p class="description"><?php echo($nomProd[$i]);?> : 
                                    <span class="prix-prod-cart"><?php echo($prixProd[$i]);?>€</span>
                                    <a class="notif-article-link" href="#"><span class="notif-article">-</span></a>
                                </p>
                                
                                <span class="id_prod" style="display:none;"><?php echo($idProd[$i]);?></span>
                                <span class="nom_prod" style="display:none;"><?php echo($nomProd[$i]);?></span>
                                <span class="id_panier" style="display:none;"><?php echo($idPanier[$i]);?></span>
                            </div>

                            <?php
                            $i = $i+1;
                        }while($donnees = $reponse->fetch());
                        $reponse->closeCursor();
                ?>
                </div>

                <div class="product-buy-complete">
                    <a id="buy-it" href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        BUY
                    </a>
                </div>

            <?php
                }
            }
            ?>
            </div>
    </body>
    <script language="javascript">
        $(document).ready(function(){
            $("#buy-it").click(function(e){
				e.preventDefault();

                $idProduit=[];
                $('.id_prod').each(function (){
                    $idProduit.push($(this).html());
				}); 

                $nomProduit=[];
                $('.nom_prod').each(function (){
                    $nomProduit.push($(this).html());
				});
                
                
                

                $idProduit = $idProduit.toString();
                $nomProduit = $nomProduit.toString();


				$idUser = <?php echo(Auth::id());?>;
                $qtAchete = <?php echo($i);?>;
                $sommeProd = <?php echo($total);?>;
				$idAction = 2; /*0 = Ajouter au panier | 1 = suppresion | 2 = Valider commande*/

				$.ajax({
					url: '/send-data',
					type: 'GET',
					data: { id_produit: $idProduit, id_user: $idUser, id_action: $idAction, id_quantite: $qtAchete, id_prix: $sommeProd, id_nomProd: $nomProduit },

					dataType : 'html',
					success : function(code_html, statut){
					   alert('Achat confirmé, vous recevrez un mail récapitulatif sous peu');
                       document.location.reload(true);
				   },

				   error : function(resultat, statut, erreur){
						console.log("statut");
						console.log("erreur");
						
				   },

				   complete : function(resultat, statut){

				   }

				});
            
        });

        $(".notif-article-link").click(function(e){
                e.preventDefault();

                // $idPanier.push($(this).siblings().html());
                $idPanier = [];
                $idPanier.push($(this).parent().siblings(".id_panier").html());
                $idPanier = $idPanier.toString();
                console.log($idPanier);

                $idAction = 1; /*0 = Ajouter au panier | 1 = suppresion | 2 = Valider commande*/

                $.ajax({
                    url: '/send-data',
                    type: 'GET',
                    data: { id_panier: $idPanier, id_action: $idAction },

                    dataType : 'html',
                    success : function(code_html, statut){
                        alert('L\'article a bien été retiré du panier');
                        document.location.reload(true);
                    },

                    error : function(resultat, statut, erreur){
                        console.log("statut");
                        console.log("erreur");
                        
                    },

                    complete : function(resultat, statut){

                    }

                });


				
            });
        }); 
    </script>
</html>