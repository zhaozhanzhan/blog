<?php

namespace App\Http\Controllers\Index;

use App\Http\Common\Code;
use App\Http\Common\RedisKey;
use App\Http\Controllers\Controller;
use App\Models\FrontTotal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{

    public function index(Request $request)
    {
        $total = FrontTotal::orderBy("created_at", "desc")->first();
        $time = strtotime($total->created_at);
        $endTime = strtotime(date("y-m-d 23:59:59"));
        $startTime = strtotime(date("y-m-d 00:00:00"));
        if ($time < $endTime && $time > $startTime) {
            echo 1;
        }
    }

}
