<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produit extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_produit'; 
}
