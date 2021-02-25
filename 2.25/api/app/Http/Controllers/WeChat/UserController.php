<?php

namespace App\Http\Controllers\WeChat;

use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Models\WeChatUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new WeChatUser();
    }

    /**
     * 登陆
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        $code = $request->input("code");
        return $this->user->login($code);
    }

    /**
     * 信息注册
     * @param Request $request
     * @return array
     */
    public function register(Request $request)
    {
        $id = $request->input("id");
        $code = $request->input("code");
        $nick_name = $request->input("nick_name");
        $avatar_url = $request->input("avatar_url");
        $gender = $request->input("gender");
        return $this->user->register($id, $code, $nick_name, $avatar_url, $gender);
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
        return $this->user->getAll($start, $pageSize);
    }

    /**
     * 删除
     * @param IdRequest $request
     * @return array
     */
    public function delete(IdRequest $request)
    {
        $id = $request->input("id");
        return $this->user->del(explode(",", $id));
    }

    /**
     * 访问时间
     * @param Request $request
     * @return array
     */
    public function visitsTime(Request $request)
    {
        $uid = $request->input("uid");
        return $this->user->visitsTime($uid);
    }
}
