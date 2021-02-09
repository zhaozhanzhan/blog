import {
    request
} from "./request"
export const index = params => {
    return request(`article/get?&currentPage=1&pageSize=10`, params,"get")
}
//访问
export const userLogin = params => {
    return request(`user/login`, params)
}
//浏览时长
export const totalVisitsTime = params => {
    return request(`total/visitsTime`, params)
}
//统计
export const totalNum = params => {
    return request(`total/num`, params)
}
//qq详情
export const qqInfo = params => {
    return request(`common/qqInfo`, params)
}
//文章列表
export const articleGet = params => {
    return request(`article/article`, params)
}
//文章详情
export const articleDetail = params => {
    return request(`article/detail`, params)
}
//文章点赞
export const articleThumb = params => {
    return request(`article/thumb`, params)
}
//链接列表
export const LinkGet = params => {
    return request(`link/link`, params)
}
//申请链接
export const LinkApply = params => {
    return request(`link/apply`, params)
}
//链接访问量
export const LinkVisitNum = params => {
    return request(`link/visitNum`, params)
}
//基本信息
export const InfoGet = params => {
    return request(`info/info`, params)
}
//留言板
export const MsgGet = params => {
    return request(`msg/msg`, params)
}
//留言
export const MsgAdd = params => {
    return request(`msg/add`, params)
}
//留言点赞
export const MsgThumb = params => {
    return request(`msg/thumb`, params)
}
//留言评论
export const MsgSubComment = params => {
    return request(`msgSub/comment`, params)
}
//子留言评论
export const MsgSubCommentSub = params => {
    return request(`msgSub/commentSub`, params)
}

//文章留言列表
export const CommentGet = params => {
    return request(`comment/comment`, params)
}

//文章留言
export const CommentAdd = params => {
    return request(`comment/add`, params)
}
//文章留言评论
export const CommentSubComment = params => {
    return request(`commentSub/comment`, params)
}
//文章子留言评论
export const CommentSubCommentSub = params => {
    return request(`commentSub/commentSub`, params)
}
//文章留言点赞
export const CommentThumb = params => {
    return request(`comment/thumb`, params)
}