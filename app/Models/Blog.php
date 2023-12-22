<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable =
    [
        'title',
        'slug',
        'content',
        'image',
        'tag_id'
    ];

    public function tag ()
    {
        return $this->belongsTo(Tag::class);
    }
}
