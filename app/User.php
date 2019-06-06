<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GrahamCampbell\Markdown\Facades\Markdown;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post', 'author_id');
    }

    public function getRouteKeyname()
    {
        return 'slug';
    }

    public function getBioHtmlAttribute($value)
    {
        return Markdown::convertToHtml($this->bio);
    }

    public function gravatar()
    {
        $email = $this->email;
        $default = "https://images.vexels.com/media/users/3/128732/isolated/preview/e759c838faf379fa09057f04c64860a9-sherlock-holmes-silhouette-by-vexels.png";
        $size = 10;

        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

    }
}
