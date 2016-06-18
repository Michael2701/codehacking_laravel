<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $uploads = '/images/';

    protected $fillable = ['name'];

    public function getNameAttribute($photo)
    {
        return $this->uploads . $photo;
    }
}
