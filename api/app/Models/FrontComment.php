<?php

namespace App\Models;

use App\Http\Common\Code;
use App\Http\Common\RedisKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class FrontComment extends Model
{
    protected $table = "blog_front_comment";
    protected $dateFormat = 'U';
    protected $fillable = ["qq", "article_id", "name", "email", "avatar", "content", "thumb_num", "master", "created_at"];

    public function msgSub()
    {
        return $this->hasMany('App\Models\FrontCommentSub', 'msg_id', "id");
    }

    public function article()
    {
        return $this->hasOne('App\Models\FrontArticle', 'id', "article_id");
    }

    /**
     * 获取
     * @param int $release 状态
     * @param int $start 起始
     * @param int $pageSize 显示多少条
     * @return array
     */
    public function getAll($release = 0, $start = 0, $pageSize = 15)
    {
        $condition = [];
        if ($release !== 0) {
            $condition = ["release" => $release];
        }
        $msg = FrontComment::with("article")->where($condition)->offset($start)->limit($pageSize)->get();
        if ($msg->isEmpty()) {
            return ["code" => Code::$SUCCESS_NO_TIP, "msg" => "空空如也！", "total" => 0, "data" => []];
        }
        $total = FrontComment::where($condition)->count();
        return ["code" => Code::$SUCCESS_NO_TIP, "msg" => "success", "total" => $total, "data" => $msg];
    }

    /**
     * 添加
     * @param $params
     * @return array
     */
    public function add($params)
    {
        $msg = FrontComment::create($params);
        if (!$msg) {
            return ["code" => Code::$WARNING, "msg" => "添加失败！"];
        }
        return ["code" => Code::$SUCCESS, "msg" => "添加成功！"];
    }

    /**
     * 删除
     * @param string $id
     * @return array
     */
    public function del($id)
    {
        $isMsg = FrontCommentSub::whereIn("msg_id", $id)->first();
        if ($isMsg) {
            return ["code" => Code::$WARNING, "msg" => "该评论含有子评论，请先删除！"];
        }
        $msg = FrontComment::destroy($id);
        if (!$msg) {
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
        $msg = FrontComment::where(["id" => $params["id"]])->update($params);
        if (!$msg) {
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
        $msg = FrontComment::where(["id" => $id])->first();
        if (!$msg) {
            return ["code" => Code::$WARNING, "msg" => "该评论不存在！"];
        }
        $msg->release = $msg->release === 1 ? 2 : 1;
        $text = $msg->release === 1 ? "审核" : "回收";
        if (!$msg->save()) {
            return ["code" => Code::$WARNING, "msg" => $text . "失败！"];
        }
        return ["code" => Code::$SUCCESS, "msg" => $text . "成功"];
    }

    /**
     * 获取已发布
     * @param int $articleId 文章Id
     * @param int $start
     * @param int $pageSize
     * @return array
     */
    public function getRelease($articleId = 0, $start = 0, $pageSize = 15)
    {
        $msg = FrontComment::with(["msgSub" => function ($query) {
            return $query->where(["release" => 1]);
        }])
            ->where(["release" => 1, "article_id" => $articleId])
            ->orderBy("created_at", "desc")
            ->offset($start)->limit($pageSize)
            ->get();
        if ($msg->isEmpty()) {
            return ["code" => Code::$SUCCESS_NO_TIP, "msg" => "空空如也", "total" => 0, "data" => []];
        }
        $total = FrontComment::where(["release" => 1, "article_id" => $articleId])->count();
        return ["code" => Code::$SUCCESS_NO_TIP, "msg" => "success", "data" => $msg, "total" => $total];
    }

    /**
     * @param int $id 留言ID
     * @param int $subId 子留言ID
     * @param int $ip IP地址
     * @return array
     */
    public function thumb($id, $subId, $ip)
    {
        if ($subId === 0) {
            $comment = FrontComment::where(["release" => 1, "id" => $id])->first();
        } else {
            $comment = FrontCommentSub::where(["release" => 1, "id" => $subId])->first();
        }
        if (!$comment) {
            return ["code" => Code::$SUCCESS_NO_TIP, "msg" => "该评论不存在！"];
        }
        $red = Redis::zscore(RedisKey::$COMMENT_THUMB_NUM, $ip . "." . $id . $subId);
        if ($red) {
            return ["code" => Code::$INFO, "msg" => "赞多了容易骄傲！"];
        }
        $res = $comment->increment("thumb_num");
        if ($res) {
            Redis::zadd(RedisKey::$COMMENT_THUMB_NUM, 1, $ip . "." . $id . $subId);
        }
        return ["code" => Code::$SUCCESS_NO_TIP, "msg" => "success"];
    }
}
