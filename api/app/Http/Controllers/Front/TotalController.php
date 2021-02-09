<?php


namespace App\Http\Controllers\Front;


use App\Http\Common\Ip;
use App\Models\FrontTotal;
use Illuminate\Http\Request;

class TotalController
{
    protected $total;

    public function __construct()
    {
        $this->total = new FrontTotal();
    }

    /**
     * 获取
     * @param Request $request
     * @return array
     */
    public function get(Request $request)
    {
        $start = $request->input("start", 0);
        $pageSize = $request->input("pageSize", 15);
        return $this->total->getAll($start, $pageSize);
    }

    /**
     * 浏览时长
     * @param Request $request
     * @return array|bool
     */
    public function visitsTime(Request $request)
    {
        $ip = Ip::getClientIp();
        return $this->total->visitsTime($ip);
    }

    /**
     * 后台数据统计
     * @return array
     */
    public function totalNum()
    {
        return $this->total->totalNum();
    }

    /**
     * 前台数据统计
     * @return array
     */
    public function num()
    {
        return $this->total->num();
    }

}
