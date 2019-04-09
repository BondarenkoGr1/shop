<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Payment extends Model
{
	use Sluggable;

    protected $fillable = ['title'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
