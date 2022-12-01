<?php

namespace App\Admin\Controllers;

use App\Model\Chapter;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;

class ApiController extends AdminController
{
    public function getFictionChapter(Request $request)
    {
        $page = $request->input('p', 1);
        $limit = $request->input('limit', 10);
        $fictionId = $request->input('fictionId');

        $query = Chapter::where('fictionId', $fictionId);
        $total = $query->count();
        $data = $query->offset(($page - 1) * $limit)->limit($limit)->get();
        return response()->json(["data" => $data, 'total' => $total]);
    }
}
