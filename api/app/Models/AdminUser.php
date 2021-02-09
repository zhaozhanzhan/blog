<?php

namespace App\Models;

use App\Http\Common\Code;
use App\Http\Common\RedisKey;
use Illuminate\Support\Facades\Redis;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminUser extends Authenticatable implements JWTSubject
{

    protected $table = "blog_admin_user";
    protected $dateFormat = 'U';
    protected $hidden = ["password", "last_ip", "ip", "last_at"];

    /**
     * @param string $username 用户名
     * @param string $password 密码
     * @param string $ip ip地址
     * @param int $captchaCode 验证码
     * @param string $captchaKey 验证码标识
     * @return array
     */
    public function login($username, $password, $ip, $captchaCode, $captchaKey)
    {
        //验证码认证
        if (!captcha_api_check($captchaCode, $captchaKey)) {
            return ["code" => Code::$WARNING, "msg" => "验证码错误！"];
        }
//       密码错误超5次
        $isLock = Redis::zscore(RedisKey::$ADMIN_LOGIN_REQUEST_LIST, $ip);
        if ($isLock) {
            return ["code" => Code::$WARNING, "msg" => "异常请求，请换设备或明日再试！"];
        }
        //token认证
        if (!$token = JWTAuth::attempt(["username" => $username, "password" => $password])) {
            $loginNum = Redis::get(RedisKey::$ADMIN_LOGIN_REQUEST_LOCK . ":" . $ip);
            $maxNum = 5;
            $time = strtotime(date("y-m-d 23:59:59")) - time();
            if ($loginNum >= $maxNum) {
                Redis::zadd(RedisKey::$ADMIN_LOGIN_REQUEST_LIST, 1, $ip);
                Redis::expire(RedisKey::$ADMIN_LOGIN_REQUEST_LIST, $time);
            }
            if ($loginNum) {
                Redis::incr(RedisKey::$ADMIN_LOGIN_REQUEST_LOCK . ":" . $ip);
            } else {
                Redis::setex(RedisKey::$ADMIN_LOGIN_REQUEST_LOCK . ":" . $ip, $time, 1);
            }
            $num = $maxNum - $loginNum;
            return ["code" => Code::$WARNING, "msg" => "账号或密码错误,还有" . $num . "次机会！"];
        }
        //上一次登陆时间
        $adminUser = AdminUser::where(["username" => $username])->first();
        $adminUser->last_at = $adminUser->updated_at->timestamp;
        $adminUser->last_ip = $adminUser->ip;
        $adminUser->ip = $ip;
        $adminUser->save();
        $res = [
            'token' => $token,
            'type' => 'bearer',
            'expires' => JWTAuth::factory()->getTTL() * 60,
        ];
        return ["code" => Code::$SUCCESS, "msg" => "登陆成功!", "data" => $res];
    }

    /**
     * token
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * token
     * @return mixed
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
