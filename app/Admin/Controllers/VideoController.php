<?php

namespace App\Admin\Controllers;

use App\Model\Video;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class VideoController extends AdminController
{
    protected $title = 'Video';

    public function grid()
    {
        $grid = new Grid(new Video());
        // $grid->column('title', __('Title'));

        // 使用laravel admin 自带的 model 模态框来展示每本小说的章节
        $grid->column('title', __('Title'))->modal('Video List', function ($model) {
            $collections = $model->collections()->take(10)->get()->map(function ($collection) {
                return $collection->only(['chapterTitle', 'chapterPath']);
            });
            return new Table(['Title', 'Path'], $collections->toArray(), ['list-table']);
        });

        Admin::css('//vjs.zencdn.net/7.10.2/video-js.min.css');
        Admin::style(' .list-table > tbody > tr{cursor: pointer;}');

        Admin::js('//vjs.zencdn.net/7.10.2/video.min.js');
        $script = <<<EOF
            var player = null;
            let elements = $('.list-table > tbody > tr');
            for (var i= 0; i < elements.length; i++) {
                $(elements[i]).attr('data-target', '#video-model')
                $(elements[i]).attr('data-toggle', 'modal')
            };
            $('.list-table > tbody > tr').click(function() {
                let video_path = $(this).find('td')[1].textContent;
                $('#source').attr('src', video_path);
                $('#source').attr('type', 'application/x-mpegURL');
                player = videojs('myVideo', {
                    bigPlayButton: true,
                    textTrackDisplay: false,
                    posterImage: false,
                    errorDisplay: false,
                    aspectRatio: "16:9"
                });
                player.on('loadeddata', () => {
                    // 先设置静音
                    player.muted(true);
                    // 再执行播放
                    player.play();
                });
                $('#video-model').on('hide.bs.modal', function (e) {
                    player = null;
                    console.log(11111111)
                })
            });
            $('body').append($(`
                <div class="modal fade" tabindex="-1" role="dialog" id="video-model">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Video Play</h4>
                      </div>
                      <div class="modal-body" style="width: 100%; height: 300px;">
                        <video id="myVideo" class="video-js vjs-default-skin vjs-big-play-centered" controls autoplay style="width: 100%; height: 100%;" >
                            <source id="source"></source>
                        </video>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            `));
EOF;

        Admin::script($script);

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
