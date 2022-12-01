<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Fiction\ChapterList;
use App\Model\Fiction;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Tools;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class FictionController extends AdminController
{
    protected $title = 'Fiction';

    public function grid()
    {
        $grid = new Grid(new Fiction());
        // 原始的 title
        $grid->column('fictionId', __('Fiction ID'));
        $grid->column('title', __('Title'));

        // 使用laravel admin 自带的 model 模态框来展示每本小说的章节
        //$grid->column('title', __('Title'))->modal('ChapterList', function ($model) {
        //    $products = $model->chapters()->take(10)->get()->map(function ($product) {
        //        return $product->only(['chapterTitle']);
        //    });
        //    return new Table(['标题'], $products->toArray());
        //});

        $script = file_get_contents(resource_path() . '/js/laravel-admin-expand-table/table.js');
        $script .= <<<EOF
            $('.column-fictionId').click(function() {
                var fictionId = this.textContent;
                laravelAdminExpandTable.init(
                    '/admin/api-v1/get_fiction_chapter',
                    {'fictionId': fictionId},
                    {chapterId: '章节ID', chapterTitle: '章节标题'},
                    10
                ).make('章节列表')
            })

EOF;
        Admin::script($script);


        $grid->column('author', __('Author'));
        $grid->column('fictionType', __('Fiction Type'))->label();
        $grid->column('chapterStatus')->label([
            'INCOMPLETE' => 'default',
            'COMPLETE' => 'success',
        ]);
        $grid->column('updateTime', __('Update Time'));
        // 使用 lightbox 可以放大图片
        // $grid->column('cover', __('Cover'))->lightbox(['width' => 80, 'height' => 80]);
        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('title');
        });
        // 行内操作按钮
        // $grid->actions(function ($actions) {
        //    $actions->add(new ChapterList($actions->row));
        // });
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
