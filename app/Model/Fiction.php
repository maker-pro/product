<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Fiction extends Model
{
    protected $table = 'fiction_introduction';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "title", "author", "fictionType", "descs", "cover", "updateTime", 'chapterStatus', 'fictionId'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        ""
    ];

    public function chapters() {
        return $this->hasMany('App\Model\Chapter', 'fictionId', 'fictionId');
    }
}
