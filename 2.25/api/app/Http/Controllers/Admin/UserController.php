<?php

namespace App\Http\Controllers\Admin;

use App\Http\Common\Ip;
use App\Http\Common\RedisKey;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\AdminUser;
use App\Models\FrontArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    protected $adminUser;


    public function __construct()
    {
        $this->adminUser = new AdminUser();
    }

    public function index(Request $request)
    {
        echo strtotime(date("y-m-d 23:59:59")) - time();
    }

    /**
     * 管理员登陆
     * @param LoginRequest $request username 账号,password 密码,captchaCode 验证码,captchaKey 验证码唯一值
     * @return array
     */
    public function login(LoginRequest $request)
    {
        $params = $request->all();
        $ip = Ip::getClientIp();
        return $this->adminUser->login($params["username"], $params["password"], $ip, $params["captchaCode"], $params["captchaKey"]);
    }

    /**
     * token刷新
     * @return int[]
     */
    public function refreshToken()
    {
        return ["code" => 1];
    }


}
