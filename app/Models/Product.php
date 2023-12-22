<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable =
    [
        'product_name',
        'slug',
        'image',
        'price',
        'availability',
        'weight',
        'description',
    ];

    public function category ()
    {
        return $this->belongsTo(Category::class);
    }
}
