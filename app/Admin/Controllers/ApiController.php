<?php

namespace App\Admin\Controllers;

use App\Model\Chapter;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends AdminController
{
    public function getFictionChapter(Request $request)
    {
        $page = $request->input('p', 1);
        $limit = $request->input('limit', 10);
        $fictionId = $request->input('fictionId');

        $query = Chapter::where('fictionId', $fictionId);
        $total = $query->count();
        $data = $query->select(DB::raw('if(chapterPath IS NULL, "否", "是") as status, chapterId, chapterTitle'))->orderBy('chapterIndex','asc')->offset(($page - 1) * $limit)->limit($limit)->get();
        return response()->json(["data" => $data, 'total' => $total]);
    }

    public function getChapterContent(Request $request)
    {
        $chapterId = $request->input('chapterId');
        $chapter_content = Chapter::getContent($chapterId);
//        return response()->json(["content" => $chapter_content, 'status' => true]);
        return response()->json(["data" => [['content' => $chapter_content]], 'total' => 1]);
    }
}


