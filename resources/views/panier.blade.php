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
                    while($donnees = $reponse->fetch()){
                        $idProd[$i] = $donnees["id_produit"];
                        $nomProd[$i] = $donnees["nom_produit"];
                        $prixProd[$i] = $donnees["prix_produit"];
                        $imgProd[$i] = $donnees["url_produit"];

                        $total = $total + $donnees['prix_produit'];

                        ?>
                        <div class="list-cart-item">
                            <?php echo('<img class="icon-descr" src="image/'.$imgProd[$i].'_1_ico.png" alt="">');?>
                            <p class="description"><?php echo($nomProd[$i]);?> : <span class="prix-prod-cart"><?php echo($prixProd[$i]);?>€</span></p>
                            <span class="id_prod" style="display:none;"><?php echo($idProd[$i]);?></span>
                            <span class="nom_prod" style="display:none;"><?php echo($nomProd[$i]);?></span>
                        </div>

                        <?php
                        $i = $i+1;
                    }
                    $reponse->closeCursor();
            ?>
            </div>

            <div class="product-buy">
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
                    console.log($nomProduit);
				});
                

                $idProduit = $idProduit.toString();
                $nomProduit = $nomProduit.toString();

                // console.log($nomProduit);

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
        });
    </script>
</html>