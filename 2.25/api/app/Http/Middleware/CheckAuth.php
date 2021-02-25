<?php

namespace App\Http\Middleware;

use App\Http\Common\Code;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class CheckAuth extends BaseMiddleware
{

    /**
     * token检测、刷新
     * @param $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {

//        echo Hash::make("elegant0117");
        //检测请求头是否带token
        if (!$this->auth->parser()->setRequest($request)->hasToken()) {
            return response()->json(["code" => Code::$ERROR_REQUEST, "msg" => "异常请求！"]);
        }
        try {
            //判断是否登陆
            $auth = $this->auth->parseToken()->authenticate();
            if (!$auth) {
                return response()->json(["code" => Code::$LOGIN_NOT, "msg" => "该管理员未登陆！"]);
            }
            $urlArr = explode("/", request()->route()->uri);
            $url = $urlArr[count($urlArr) - 1];
            $WeChatUrl = $urlArr[count($urlArr) - 3];
            file_put_contents("aa", $WeChatUrl);
            //刷新token
            if ($url === "refreshToken") {
                return response()->json($this->refreshToken());
            }
            //退出登陆
            if ($url === "logout") {
                auth()->logout();
                return response()->json(["code" => Code::$SUCCESS, "msg" => "注销成功！"]);
            }
            //权限
            if ($auth->power === 2 && $this->handleRouterPower($url)) {
                return response()->json(["code" => Code::$WARNING, "msg" => "管理员没有该操作权限！"]);
            }
            if ($auth->power === 2 && $WeChatUrl == "wechat") {
                return response()->json(["code" => Code::$WARNING, "msg" => "管理员没有该操作权限！"]);
            }
            return $next($request);
        } catch (JWTException $e) {
            try {
                return response()->json($this->refreshToken());
            } catch (JWTException $e) {
                //token过期，重新登陆
                return response()->json(["code" => Code::$LOGIN_EXPIRE, "msg" => "身份效验过期，请重新登陆！"]);
            }
        }
    }

    public function handleRouterPower($url)
    {
        if ($url === "delete" || $url === "edit" || $url === "release") {
            return true;
        }
        return false;
    }

    /**
     * token刷新
     * @return array
     */
    public function refreshToken()
    {
        $token = $this->auth->refresh();
        $res = [
            'token' => $token,
            'type' => 'bearer',
            'expires' => $this->auth->factory()->getTTL() * 60
        ];
        return ["code" => Code::$TOKEN_REFRESH_SUCCESS, "msg" => "刷新成功！", "data" => $res];
    }
}
