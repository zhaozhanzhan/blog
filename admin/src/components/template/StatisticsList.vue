<template>
    <div class="statistics-list app-card">
        <div class="title">数据统计(总数/待审核)</div>
        <div class="content ht-flex ht-wrap ht-row-between ht-col-between">
            <div class="item ht-flex ht-row-between ht-col-center num-bg-1">
                <div class="left"><i class="iconfont icon-user"></i></div>
                <div class="right">
                    <div>在线人数（人）</div>
                    <div>{{ online }}</div>
                </div>
            </div>
            <div class="item ht-flex ht-row-between ht-col-center num-bg-2">
                <div class="left"><i class="iconfont icon-user"></i></div>
                <div class="right">
                    <div>访客量（人）</div>
                    <div>{{ num.visitors_num }}</div>
                </div>
            </div>
            <div class="item ht-flex ht-row-between ht-col-center num-bg-3">
                <div class="left"><i class="iconfont icon-user"></i></div>
                <div class="right">
                    <div>访问量（次）</div>
                    <div>{{ num.visits_num }}</div>
                </div>
            </div>
            <div class="item ht-flex ht-row-between ht-col-center num-bg-8">
                <div class="left"><i class="iconfont icon-user"></i></div>
                <div class="right">
                    <div>浏览时长（时）</div>
                    <div>{{ (num.visits_time / 60).toFixed(2) }}</div>
                </div>
            </div>
            <div class="item ht-flex ht-row-between ht-col-center num-bg-4">
                <div class="left"><i class="iconfont icon-user"></i></div>
                <div class="right">
                    <div>文章（章）</div>
                    <div>
                        {{ num.article_num }}/{{ num.article_verify_num }}
                    </div>
                </div>
            </div>
            <div class="item ht-flex ht-row-between ht-col-center num-bg-5">
                <div class="left"><i class="iconfont icon-user"></i></div>
                <div class="right">
                    <div>留言（条）</div>
                    <div>
                        {{ num.message_num }}/{{ num.message_verify_num }}
                    </div>
                </div>
            </div>
            <div class="item ht-flex ht-row-between ht-col-center num-bg-6">
                <div class="left"><i class="iconfont icon-user"></i></div>
                <div class="right">
                    <div>友链（条）</div>
                    <div>{{ num.link_num }}/{{ num.link_verity_num }}</div>
                </div>
            </div>
            <div class="item ht-flex ht-row-between ht-col-center num-bg-7">
                <div class="left"><i class="iconfont icon-user"></i></div>
                <div class="right">
                    <div>评论（条）</div>
                    <div>
                        {{ num.comment_num }}/{{ num.comment_verify_num }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "StatisticsList",
    props: {
        num: Object,
        online: Number,
    },
};
</script>

<style lang="scss" scoped>
.statistics-list {
    height: 100%;
    .item {
        border-radius: 5px;
        width: 24%;
        height: 80px;
        color: $ht-white;
        margin-bottom: 10px;
        .left {
            padding-left: 10px;
            i {
                font-size: 28px;
            }
        }
        .right {
            padding-right: 10px;
            text-align: center;
            line-height: 150%;
        }
    }
}

.num-bg-1 {
    background: #e6862d;
}
.num-bg-2 {
    background: #af7120;
}
.num-bg-3 {
    background: #c25801;
}
.num-bg-4 {
    background: #089ea8;
}
.num-bg-5 {
    background: #0fb2b8;
}
.num-bg-6 {
    background: #0b9986;
}
.num-bg-7 {
    background: #02ceb3;
}
.num-bg-8 {
    background: #f87102;
}
</style>