<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'fiction_chapter_list';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "chapterTitle", "chapterPath"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
