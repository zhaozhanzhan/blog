<?php

namespace App\Http\Controllers\Common;

use App\Http\Common\Code;
use App\Http\Controllers\Controller;
use App\Http\Requests\QQRequest;
use Illuminate\Http\Request;
use Mews\Captcha\Captcha;

class CommonController extends Controller
{
    /**
     * 验证码
     * @param Captcha $captcha
     * @return int[]
     * @throws \Exception
     */
    public function captcha(Captcha $captcha)
    {
        return ["code" => 1, "data" => $captcha->create('flat', true)];
    }

    /**
     * qq详情
     * @param QQRequest $request
     * @return array
     */
    public function qqInfo(QQRequest $request)
    {
        $qq = $request->post("qq");
        $html = file_get_contents('http://r.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?uins=' . $qq);
        $nickName = trim(mb_convert_encoding(explode(',', $html)[6], "UTF-8", "GBK"), '"');
        $avatar = "https://q.qlogo.cn/headimg_dl?dst_uin=$qq&spec=100";
        $email = "$qq@qq.com";
        return [
            "code" => Code::$SUCCESS_NO_TIP,
            "msg" => "success",
            "data" => [
                "nickName" => $nickName,
                "avatar" => $avatar,
                "email" => $email
            ]
        ];
    }

    /**
     * 图片上传
     * @param Request $request
     * @return array
     */
    public function upload(Request $request)
    {
        $file = $request->file("image");
        $allowed_extensions = ["png", "jpg", "gif"];
        if (!in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ["code" => Code::$WARNING, "msg" => "只能上传png、jpg、gif类型的图片!"];
        }
        $destinationPath = 'upload/article/' . date("Ymd") . '/';
        $extension = $file->getClientOriginalExtension();
        $fileName = md5(time() . rand(1, 1000)) . '.' . $extension;
        $file->move($destinationPath, $fileName);
        $filePath = asset($destinationPath . $fileName);
        $filePath = str_replace("blog", "HtBlog/public", $filePath);
        return ["code" => Code::$SUCCESS, "msg" => "上传成功！", "data" => $filePath];
    }

    public function remove(Request $request)
    {
        $params = $request->input("");
        return ["code" => Code::$SUCCESS_NO_TIP, "data" => $params];
    }

}
