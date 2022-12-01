<?php
/**
 * UnSerialize.php
 * User: Joe
 * Date: 2022/12/1
 * Time: 17:53
 */

namespace App\Admin\Extensions\Show;

use Encore\Admin\Show\AbstractField;

class ChapterList extends AbstractField
{
    public $escape = false;
    public function render($arg = '')
    {
        return "<span style='color: #00f7de'>{$arg}</span>";
    }
}
