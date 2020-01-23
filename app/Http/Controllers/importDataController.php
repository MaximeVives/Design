<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\produit;
use App\panier;

class importDataController extends Controller
{
    public function importProduit(){
        // $produit = produit::where('id_produit', '=', 1)->get();
        $produit = produit::find(1);        
		return view("accueil", array('dataProduit' => $produit));
    }
    
    public function cartData(){
        // $produit = produit::where('id_produit', '=', 1)->get();
        // $produit = produit::find(1);        
		return view("panier");
	}
}
