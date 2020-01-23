<?php
  /*header('Location: http://www.bde-cesi.test/boutique');
  exit();*/


/*========================AJOUTER AU PANIER====================================*/
		
		if(intval($_GET["id_action"])===0){
		
			$iduser = intval($_GET["id_user"]);
			$idProduct = intval($_GET["id_produit"]);


			$bdd = new PDO('mysql:host=localhost;dbname=design;charset=utf8', 'root', 'root');
			$reponse = $bdd->prepare("CALL AjoutPanier(:P_user, :P_obj);");

			$reponse->execute(array(':P_user' => $iduser, ':P_obj' => $idProduct));
			$reponse->closeCursor();
		}


/*======================================================================*/
/*===================================EFFACER DU PANIER===========================*/

		elseif(intval($_GET["id_action"])===1){
			$iduser = intval($_GET["id_user"]);
			$idProduct = intval($_GET["id_objet"]);
			
			$bdd = new PDO('mysql:host=localhost;dbname=bde-cesi;charset=utf8', 'root', 'root');
			$reponse = $bdd->prepare("CALL DelProduitPanier(:P_user, :P_obj);");

			$reponse->execute(array(':P_user' => $iduser, ':P_obj' => $idProduct));
			$reponse->closeCursor();
			header('Location: /panier');
  			exit();
		}

/*=============================VALIDER COMMANDE============================*/

		elseif(intval($_GET["id_action"])===2){
			$idProduit = $_GET["id_produit"];
			$nomProduit = $_GET["id_nomProd"];
			$iduser = $_GET["id_user"];
			$total = $_GET["id_prix"];	
			$quantite = $_GET["id_quantite"];	

			
			$idProduit = explode(",", $idProduit);
			$nomProduit = explode(",", $nomProduit);
			
			$bdd = new PDO('mysql:host=localhost;dbname=design;charset=utf8', 'root', 'root');

			for($incr=0; $incr<$quantite; $incr++){

				$idProduit[$incr]=intval($idProduit[$incr]);

				$reponse = $bdd->prepare("CALL MajQuantite(:P_idProd);");
				$reponse->execute(array(":P_idProd" => $idProduit[$incr]));
				
			}

			$quantite = intval($quantite);
			$user = intval(Auth::id());


			$reponse->closeCursor();
			

			$message = "Bonjour, je suis un mail généré par le site de Maxime Vives et envoyé depuis son adresse mail. Le bon de commande suivant n'est qu'un test n'ayez pas peur :
";
			$message = $message."Les articles suivant ont bien été acheté : ";

			for ($a=0; $a < $quantite; $a++) { 
				$message = $message.$nomProduit[$a].", ";
			}



			
			ini_set( 'display_errors', 1 );
			error_reporting( E_ALL );
			$from = "hastagmaxime@gmail.com";
			$to = Auth::user()->email;
			$subject = "Confirmation de votre Achat";
			$message = $message."pour un total de : ".$total."€.
";
			$message = $message."Merci pour votre achat !";
			
			$headers = "From:" . $from;
			mail($to,$subject,$message, $headers);

			echo "L'email a été envoyé.";
			
			
			$reponse = $bdd->prepare("CALL DelAllPanier(:P_user);");
			$reponse->execute(array(":P_user" => $iduser));
			
			$reponse->closeCursor();
		}

/*============================AJOUTER UN PARTICIPANT===================================*/
		elseif(intval($_GET["id_action"])===3){
			$iduser = intval($_GET["id_user"]);
			$idEvent = intval($_GET["id_event"]);


			$bdd = new PDO('mysql:host=localhost;dbname=bde-cesi;charset=utf8', 'root', 'root');
			$reponse = $bdd->prepare("CALL AjoutParticipant(:P_user, :P_act);");

			$reponse->execute(array(':P_user' => $iduser, ':P_act' => $idEvent));
			$reponse->closeCursor();
		}

/*============================================================================*/


/*============================SIGNALEMENT===================================*/
		elseif(intval($_GET["id_action"])===4){
			$iduser = intval($_GET["id_user"]);
			$idEvent = intval($_GET["id_event"]);

			
			ini_set( 'display_errors', 1 );
			error_reporting( E_ALL );
			$from = "maxime.vives@viacesi.fr";
			$to = "maxime.vives@viacesi.fr";
			$subject = "REPORT d'une activité";
			$message = "L'activité suivante a été signalé' : ".$idEvent.", Par l'utilisateur : ".$iduser.".
L'image ou le contenu est susceptible de ne pas respecter la réglementation du CESI.
Merci de bien vouloir modifier ou supprimer cet événement.";
			$headers = "From:" . $from;
			mail($to,$subject,$message, $headers);

			echo "L'email a été envoyé.";
			
		}


/*============================================================================*/

















?>