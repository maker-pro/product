<?php

namespace App\Admin\Controllers;

use App\Model\Fiction;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
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
        $grid->column('descs', __('Deatil'))->width(400);
        $grid->column('cover', __('Cover'))->lightbox(['width' => 80, 'height' => 80]);
        $grid->column('updateTime', __('Update Time'));

        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('title');
        });
        return $grid;
    }

    public function detail($id)
    {
        $show = new Show(Fiction::findOrFail($id));
        $show->field('title', __('Title'));
        $show->field('author', __('Author'));
        $show->field('fictionType', __('Fiction Type'));
        $show->field('descs', __('Detail'));
        $show->field('cover', __('Cover'))->image('', 150, 150);;
        $show->field('updateTime', __('Update Time'));
        return $show;
    }

//    public function edit($id)
//    {
//        $form = new Form(new Video());
//        $form->edit($id);
//        return $form;
//    }
}
