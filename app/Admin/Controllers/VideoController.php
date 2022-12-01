<?php

namespace App\Admin\Controllers;

use App\Model\Video;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VideoController extends AdminController
{
    protected $title = 'Video';

    public function grid()
    {
        $grid = new Grid(new Video());
        $grid->column('title', __('Title'));
        $grid->column('director', __('Director'))->width(300);
        $grid->column('actor', __('Actor'))->width(300);
        $grid->column('region', __('Region'));
        $grid->column('videoType', __('Video Type'));
        $grid->column('releaseTime', __('Release Time'));

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
        $show = new Show(Video::findOrFail($id));
        $show->field('title', __('Title'));
        $show->field('director', __('Director'));
        $show->field('actor', __('Actor'));
        $show->field('region', __('Region'));
        $show->field('videoType', __('Video Type'));
        $show->field('releaseTime', __('Release Time'));
        $show->field('cover', __('Cover'))->image('', 150, 150);
        $show->field('descs', __('Deatil'));
        return $show;
    }

//    public function edit($id)
//    {
//        $form = new Form(new Video());
//        $form->edit($id);
//        return $form;
//    }
}
