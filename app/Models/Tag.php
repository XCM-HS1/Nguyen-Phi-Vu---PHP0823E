<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable =
    [
        'name',
        'slug',
    ];

    public function blog ()
    {
        return $this->hasMany(Blog::class);
    }
}
