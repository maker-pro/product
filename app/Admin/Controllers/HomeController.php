<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\Redis;
use function MongoDB\BSON\toJSON;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
    }

    public function report(Content $content)
    {
        return $content
            ->title('Report')
            ->row(function (Row $row) {
                $report = json_decode(Redis::get('report'), true);
                $video = [
                    'video_num' => $report['video_num'],
                    'fiction_num' => $report['fiction_num'],
                ];
                $fiction = [
                    'fiction_incomplete_num' => $report['fiction_num'] - $report['fiction_complete_num'],
                    'fiction_complete_num' => $report['fiction_complete_num']
                ];
                $doughnut = view('admin.chartjs.doughnut', $fiction);
                $row->column(1 / 3, new Box('Fiction Report', $doughnut));
                $bar = view('admin.chartjs.bar', $video);
                $row->column(1 / 3, new Box('Video Report', $bar));
            });
    }
}
