<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'id','idCategoria','name', 'cover', 'image','footer_image','description','product_is_active', 'created_at', 'updated_at', 'deleted_at','is_offer'
    ];
}
