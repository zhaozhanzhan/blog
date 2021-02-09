<?php

namespace App\Http\Controllers\Front;

use App\Http\Common\Ip;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Http\Requests\MessageRequest;
use App\Models\FrontMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $msg;

    public function __construct()
    {
        $this->msg = new FrontMessage();
    }

    /**
     * 获取
     * @param Request $request
     * @return array
     */
    public function get(Request $request)
    {
        $release = $request->input("release", 0);
        $start = $request->input("start", 0);
        $pageSize = $request->input("pageSize", 15);
        return $this->msg->getAll($release, $start, $pageSize);
    }

    /**
     * 修改
     * @param MessageRequest $request
     * @return array
     */
    public function edit(MessageRequest $request)
    {
        $params = $request->all();
        return $this->msg->edit($params);
    }

    /**
     * 删除
     * @param IdRequest $request
     * @return array
     */
    public function delete(IdRequest $request)
    {
        $id = $request->post("id");
        return $this->msg->del(explode(",", $id));
    }

    /**
     * 添加
     * @param MessageRequest $request
     * @return array
     */
    public function add(MessageRequest $request)
    {
        $params = $request->all();
        return $this->msg->add($params);
    }

    /**
     * 发布
     * @param IdRequest $request
     * @return array
     */
    public function release(IdRequest $request)
    {
        $id = $request->post("id");
        return $this->msg->release($id);
    }

    /**
     * 获取已发布
     * @param Request $request
     * @return array
     */
    public function getRelease(Request $request)
    {
        $params = $request->all();
        return $this->msg->getRelease($params["start"], $params["pageSize"]);
    }

    /**
     * 点赞
     * @param IdRequest $request
     * @return array
     */
    public function thumb(IdRequest $request)
    {
        $id = $request->input("id", 0);
        $subId = $request->input("subId", 0);
        $ip = Ip::getClientIp();
        return $this->msg->thumb($id, $subId, $ip);
    }

}
