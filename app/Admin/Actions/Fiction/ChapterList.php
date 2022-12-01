<?php

namespace App\Admin\Actions\Fiction;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class ChapterList extends RowAction
{
    public $name = 'ChapterList';

    public function handle(Model $model)
    {
        return $this->response()->success($model->title)->refresh();
    }

//    public function form()
//    {
//        $this->file('file', '请选择文件');
//    }
    public function grid() {

    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default chapter-list">章节列表</a>
HTML;
    }
}
