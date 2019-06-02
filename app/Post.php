<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function getImageUrlAttribute()
    {
        $imageUrl = "";
        if(!is_null($this->image)) {
            $imagePath = public_path() . "/img/" . $this->image;
            if(file_exists($imagePath)) {
                $imageUrl = asset("img/" . $this->image);
            }
        }
        return $imageUrl;
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
