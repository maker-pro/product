<?php

namespace App\Admin\Controllers;

use App\Model\Video;
use App\User;
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
        $grid->column('cover', __('Cover'))->image('', 100, 100);
        $grid->column('releaseTime', __('Release Time'));
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
        $show->field('cover', __('Cover'));
        $show->field('releaseTime', __('Release Time'));
        return $show;
    }

//    public function edit($id)
//    {
//        $form = new Form(new Video());
//        $form->edit($id);
//        return $form;
//    }
}
