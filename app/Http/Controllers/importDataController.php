<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\produit;

class importDataController extends Controller
{
    public function importProduit(){
        // $produit = produit::where('id_produit', '=', 1)->get();
        $produit = produit::find(1);
        // dd($produit);

        
        
		return view("accueil", array('dataProduit' => $produit));
	}
}
