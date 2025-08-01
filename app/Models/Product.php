<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    protected $fillable = ['title','description','image','price','category','quantity'];
    use Sluggable;
    public function Sluggable(): array
    {
        return [
            'slug'=>
            [
                'source'=>'title'
            ]
        ];
    }

}
