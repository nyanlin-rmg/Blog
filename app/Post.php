<?php

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
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

    public function dateFormatted($showTime = false)
    {
        $format = "d/m/Y";
        if ($showTime) {
            $format = $format . "H:i:s";
        }
        return $this->created_at->format($format);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getBodyHtmlAttribute($value)
    {
        return Markdown::convertToHtml($this->body);
    }

    public function getExcerptHtmlAttribute($value)
    {
        return Markdown::convertToHtml($this->excerpt);
    }
}
