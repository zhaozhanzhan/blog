<?php

namespace App\Models;

use App\Http\Common\Code;
use Illuminate\Database\Eloquent\Model;

class FrontTypeLog extends Model
{
    protected $table = "blog_front_type_log";
    protected $dateFormat = 'U';
    protected $fillable = ["title", "sort", "created_at"];

    /**
     * 获取
     * @param int $start 起始
     * @param int $pageSize 显示多少条
     * @return array
     */
    public function getAll($start = 0, $pageSize = 15)
    {

        $type = FrontTypeLog::orderBy('sort', 'asc')->offset($start)->limit($pageSize)->get();
        if ($type->isEmpty()) {
            return ["code" => Code::$SUCCESS_NO_TIP, "msg" => "空空如也！", "total" => 0, "data" => []];
        }
        $total = FrontTypeLog::count();
        return ["code" => Code::$SUCCESS_NO_TIP, "msg" => "success", "total" => $total, "data" => $type];
    }

    /**
     * 添加
     * @param string $title 类别标题
     * @param int $sort 权重
     * @param int $created_at 创建时间
     * @return array
     */
    public function add($title, $sort, $created_at)
    {
        $type = FrontTypeLog::create(["title" => $title, "sort" => $sort, "created_at" => $created_at]);
        if (!$type) {
            return ["code" => Code::$WARNING, "msg" => "添加失败！", "data" => $type];
        }
        return ["code" => Code::$SUCCESS, "msg" => "添加成功！", "data" => $type];
    }

    /**
     * 删除
     * @param string $id
     * @return array
     */
    public function del($id)
    {
        $isLog = FrontLog::where(["type" => $id])->first();
        if ($isLog) {
            return ["code" => Code::$WARNING, "msg" => "日志设置该类别，请删除后重试！"];
        }
        $type = FrontTypeLog::destroy($id);
        if (!$type) {
            return ["code" => Code::$WARNING, "msg" => "删除失败！"];
        }
        return ["code" => Code::$SUCCESS, "msg" => "删除成功！"];
    }

    /**
     * 修改
     * @param $params
     * @return array
     */
    public function edit($params)
    {
        $type = FrontTypeLog::where(["id" => $params["id"]])->update($params);
        if (!$type) {
            return ["code" => Code::$WARNING, "msg" => "修改失败！"];
        }
        return ["code" => Code::$SUCCESS, "msg" => "修改成功！"];
    }

    /**
     * 发布
     * @param int $id id
     * @return array
     */
    public function release($id)
    {
        $type = FrontTypeLog::where(["id" => $id])->first();
        if (!$type) {
            return ["code" => Code::$WARNING, "msg" => "该类别不存在！"];
        }
        $msg = $type->release === 1 ? "回收" : "发布";
        $type->release = $type->release === 1 ? 2 : 1;
        if (!$type->save()) {
            return ["code" => Code::$WARNING, "msg" => $msg . "失败！"];
        }
        return ["code" => Code::$SUCCESS, "msg" => $msg . "成功！"];
    }

    /**
     * 获取已发布
     * @return array
     */
    public function getRelease()
    {
        $type = FrontTypeLog::where(["release" => 1])->get();
        if ($type->isEmpty()) {
            return ["code" => Code::$SUCCESS_NO_TIP, "msg" => "空空如也！", "data" => []];
        }
        return ["code" => Code::$SUCCESS_NO_TIP, "msg" => "success", "data" => $type];
    }
}
