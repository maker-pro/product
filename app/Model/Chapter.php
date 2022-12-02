<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'fiction_chapter_list';
    private static $source_path = '/www/site/product/public/';
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

    public static function getContent($chapterId) {
        $row = self::where('chapterId', $chapterId)->first();
        $path = self::$source_path . $row->chapterPath;
        if (!is_file($path)) {
            return '';
        }
        $content = file_get_contents($path);
        $content = self::funcGzuncompress($content);
        return $content;
    }

    // 解压缩方法 Start
    private static function funcGzuncompress($str)
    {
        if (self::funcIsBase64($str)) {
            return gzuncompress(base64_decode($str));
        }
        return $str;
    }
    private static function funcIsBase64($str)
    {
        return $str == base64_encode(base64_decode($str)) ? true : false;
    }
    // 解压缩方法 End
}
