<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tag;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name'];

    public function tags()
    {
       return $this->belongsToMany(Tag::class);
    }

}
