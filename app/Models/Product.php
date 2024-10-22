<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','external_id','title', 'description', 'price','rating', 'discountPercentage',
        'stock', 'brand', 'category', 'thumbnail','images','sort_order',
    ];

    //jika kolom 'images' adalah array
    protected $casts = [
        'images' => 'array',
    ];

    protected $guarded = ['api_id'];
}
