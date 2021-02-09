import {
    request
} from "./request"
//测试
export const index = params => {
    return request(`admin/index`, params, "get")
}

//验证码
export const captcha = params => {
    return request(`common/captcha`, params)
}
//后台登陆
export const login = params => {
    return request(`admin/login`, params)
}
//退出登陆
export const logout = params => {
    return request(`admin/logout`, params)
}
//刷新token
export const refreshToken = params => {
    return request(`admin/refreshToken`, params)
}

//qq详情
export const qqInfo = params => {
    return request(`common/qqInfo`, params)
}
/**
 * PC用户
 */
//获取
export const UserGet = params => {
    return request(`user/get`, params)
}
//删除
export const UseDel = params => {
    return request(`user/delete`, params)
}
//发布
export const UseRelease = params => {
    return request(`user/release`, params)
}

/**
 * 文章
 */
//获取
export const ArticleGet = params => {
    return request(`article/get`, params)
}
//添加
export const ArticleAdd = params => {
    return request(`article/add`, params)
}
//修改
export const ArticleEdit = params => {
    return request(`article/edit`, params)
}
//删除
export const ArticleDel = params => {
    return request(`article/delete`, params)
}
//发布
export const ArticleRelease = params => {
    return request(`article/release`, params)
}
//搜索
export const ArticleSearch = params => {
    return request(`article/search`, params)
}
//图片上传
export const upload = params => {
    return request(`common/upload`, params)
}
//删除文件
export const remove = params => {
    return request(`common/remove`, params)
}
/**
 * 统计
 */
//获取
export const TotalGet = params => {
    return request(`total/get`, params)
}
//统计
export const TotalNum = params => {
    return request(`total/totalNum`, params)
}

/**
 * 文章类别
 */
//获取
export const TypeGet = params => {
    return request(`type/get`, params)
}
//获取已发布
export const TypeGetRelease = params => {
    return request(`type/getRelease`, params)
}
//发布
export const TypeRelease = params => {
    return request(`type/release`, params)
}
//添加
export const TypeAdd = params => {
    return request(`type/add`, params)
}
//编辑
export const TypeEdit = params => {
    return request(`type/edit`, params)
}
//删除
export const TypeDel = params => {
    return request(`type/delete`, params)
}
/**
 * 日志类别
 */
//获取
export const TypeLogGet = params => {
    return request(`typeLog/get`, params)
}
//获取已发布
export const TypeLogGetRelease = params => {
    return request(`typeLog/getRelease`, params)
}
//发布
export const TypeLogRelease = params => {
    return request(`typeLog/release`, params)
}
//添加
export const TypeLogAdd = params => {
    return request(`typeLog/add`, params)
}
//编辑
export const TypeLogEdit = params => {
    return request(`typeLog/edit`, params)
}
//删除
export const TypeLogDel = params => {
    return request(`typeLog/delete`, params)
}
/**
 * 日志
 */
//获取
export const LogGet = params => {
    return request(`log/get`, params)
}
//获取已发布
export const LogGetRelease = params => {
    return request(`log/getRelease`, params)
}
//发布
export const LogRelease = params => {
    return request(`log/release`, params)
}
//添加
export const LogAdd = params => {
    return request(`log/add`, params)
}
//编辑
export const LogEdit = params => {
    return request(`log/edit`, params)
}
//删除
export const LogDel = params => {
    return request(`log/delete`, params)
}
/**
 * 链接
 */
//获取
export const LinkGet = params => {
    return request(`link/get`, params)
}
//添加
export const LinkAdd = params => {
    return request(`link/add`, params)
}
//修改
export const LinkEdit = params => {
    return request(`link/edit`, params)
}
//删除
export const LinkDel = params => {
    return request(`link/delete`, params)
}
//发布
export const LinkRelease = params => {
    return request(`link/release`, params)
}


/**
 * 基本信息
 */
//获取
export const InfoGet = params => {
    return request(`info/get`, params)
}
//获取已发布
export const InfoGetRelease = params => {
    return request(`info/getRelease`, params)
}
//发布
export const InfoRelease = params => {
    return request(`info/release`, params)
}
//添加
export const InfoAdd = params => {
    return request(`info/add`, params)
}
//编辑
export const InfoEdit = params => {
    return request(`info/edit`, params)
}
//删除
export const InfoDel = params => {
    return request(`info/delete`, params)
}

/**
 * 留言
 */
//获取
export const MsgGet = params => {
    return request(`msg/get`, params)
}
//获取已发布
export const MsgGetRelease = params => {
    return request(`msg/getRelease`, params)
}
//发布
export const MsgRelease = params => {
    return request(`msg/release`, params)
}
//添加
export const MsgAdd = params => {
    return request(`msg/add`, params)
}
//编辑
export const MsgEdit = params => {
    return request(`msg/edit`, params)
}
//删除
export const MsgDel = params => {
    return request(`msg/delete`, params)
}

/**
 * 子留言
 */
//获取
export const MsgSubGet = params => {
    return request(`msgSub/get`, params)
}
//获取已发布
export const MsgSubGetRelease = params => {
    return request(`msgSub/getRelease`, params)
}
//发布
export const MsgSubRelease = params => {
    return request(`msgSub/release`, params)
}
//添加
export const MsgSubAdd = params => {
    return request(`msgSub/add`, params)
}
//编辑
export const MsgSubEdit = params => {
    return request(`msgSub/edit`, params)
}
//删除
export const MsgSubDel = params => {
    return request(`msgSub/delete`, params)
}
//评论
export const MsgSubComment = params => {
    return request(`msgSub/comment`, params)
}
//评论
export const MsgSubCommentSub = params => {
    return request(`msgSub/commentSub`, params)
}

/**
 * 评论
 */
//获取
export const CommentGet = params => {
    return request(`comment/get`, params)
}
//获取已发布
export const CommentGetRelease = params => {
    return request(`comment/getRelease`, params)
}
//发布
export const CommentRelease = params => {
    return request(`comment/release`, params)
}
//添加
export const CommentAdd = params => {
    return request(`comment/add`, params)
}
//编辑
export const CommentEdit = params => {
    return request(`comment/edit`, params)
}
//删除
export const CommentDel = params => {
    return request(`comment/delete`, params)
}

/**
 * 子评论
 */
//获取
export const CommentSubGet = params => {
    return request(`commentSub/get`, params)
}
//获取已发布
export const CommentSubGetRelease = params => {
    return request(`commentSub/getRelease`, params)
}
//发布
export const CommentSubRelease = params => {
    return request(`commentSub/release`, params)
}
//添加
export const CommentSubAdd = params => {
    return request(`commentSub/add`, params)
}
//编辑
export const CommentSubEdit = params => {
    return request(`commentSub/edit`, params)
}
//删除
export const CommentSubDel = params => {
    return request(`commentSub/delete`, params)
}
//评论
export const CommentSubComment = params => {
    return request(`commentSub/comment`, params)
}
//评论
export const CommentSubCommentSub = params => {
    return request(`commentSub/commentSub`, params)
}

/**
 * WeChat用户
 */
//获取
export const WeChatUserGet = params => {
    return request(`wechat/user/get`, params)
}
//删除
export const WeChatUseDel = params => {
    return request(`wechat/user/delete`, params)
}