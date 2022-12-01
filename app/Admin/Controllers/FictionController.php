<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Fiction\ChapterList;
use App\Model\Fiction;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Tools;
use Encore\Admin\Show;

class FictionController extends AdminController
{
    protected $title = 'Fiction';

    public function grid()
    {
        $grid = new Grid(new Fiction());
        $grid->column('title', __('Title'));
        $grid->column('author', __('Author'));
        $grid->column('fictionType', __('Fiction Type'))->label();
        $grid->column('chapterStatus')->label([
            'INCOMPLETE' => 'default',
            'COMPLETE' => 'success',
        ]);
        $grid->column('updateTime', __('Update Time'));
        // $grid->column('cover', __('Cover'))->lightbox(['width' => 80, 'height' => 80]);
        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('title');
        });
        $grid->actions(function ($actions) {
            $actions->add(new ChapterList($actions->row));
        });
        return $grid;
    }

    public function detail($id)
    {
        $model = Fiction::findOrFail($id);
        $show = new Show($model);
        $show->field('title', __('Title'));
        $show->field('author', __('Author'));
        $show->field('fictionType', __('Fiction Type'));
        $show->field('updateTime', __('Update Time'));
        $show->field('cover', __('Cover'))->image('', 150, 150);;
        $show->field('descs', __('Detail'));
        $show->column('Chapter List')->chapter_list($model->title);
//        $chapter_list = array();
//        foreach ($model->chapters()->get(['fictionId', 'chapterTitle', 'chapterId']) as $chapter) {
//            $index = $chapter->chapterTitle;
//            if (preg_match('@(\d+)@', $chapter->chapterTitle, $g)) {
//                $index = $g[1];
//            }
//            $chapter_list[] = array(
//                'fictionId' => $chapter->fictionId,
//                'chapterTitle' => $chapter->chapterTitle,
//                'chapterId' => $chapter->chapterId,
//                'index' => $index
//            );
//        }
//        array_multisort(array_column($chapter_list, 'index'), SORT_ASC, $chapter_list);
        return $show;
    }

//    public function edit($id)
//    {
//        $form = new Form(new Video());
//        $form->edit($id);
//        return $form;
//    }
}
