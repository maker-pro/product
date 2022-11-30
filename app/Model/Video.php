<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video_introduction';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "title", "director", "actor", "region", "videoType", "descs", "cover", "releaseTime"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "videoId"
    ];

//    public function getActorAttribute() {
//        return array_map('trim', explode(',', $this->attributes['actor']));
//    }
//
//    public function getDirectorAttribute() {
//        return array_map('trim', explode(',', $this->attributes['director']));
//    }
}
