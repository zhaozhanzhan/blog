<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Http\Requests\TypeRequest;
use App\Models\FrontTypeLog;
use Illuminate\Http\Request;

class TypeLogController extends Controller
{
    protected $type;

    public function __construct()
    {
        $this->type = new FrontTypeLog();
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
        return $this->type->getAll($start, $pageSize);
    }

    /**
     * 修改
     * @param TypeRequest $request
     * @return array
     */
    public function edit(TypeRequest $request)
    {
        $params = $request->all();
        return $this->type->edit($params);
    }

    /**
     * 删除
     * @param IdRequest $request
     * @return array
     */
    public function delete(IdRequest $request)
    {
        $id = $request->post("id");
        return $this->type->del(explode(",", $id));
    }

    /**
     * 添加
     * @param TypeRequest $request
     * @return array
     */
    public function add(TypeRequest $request)
    {
        $params = $request->all();
        return $this->type->add($params["title"], $params["sort"], $params["created_at"]);
    }

    /**
     * 发布
     * @param IdRequest $request
     * @return array
     */
    public function release(IdRequest $request)
    {
        $id = $request->post("id");
        return $this->type->release($id);
    }

    /**
     * 获取已发布
     * @param Request $request
     * @return array
     */
    public function getRelease(Request $request)
    {
        return $this->type->getRelease();
    }
}
