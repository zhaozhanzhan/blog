<template>
    <div class="detail">
        <Loading v-show="LoadingFlag" :tip="$store.state.blackTip"></Loading>
        <div
            class="article-detail ht-white ht-flex ht-flow-column"
            v-for="(item, key) in detail"
            :key="key"
        >
            <div class="title ht-font-size-20px ht-weight">
                {{ item.title }}
            </div>
            <div class="statistics ht-flex ht-row-center">
                <div class="item ht-flex ht-font-size-12px">
                    <div class="left">分类</div>
                    <div class="right right-bg-1">
                        {{ item.front_type.title }}
                    </div>
                </div>
                <div class="item ht-flex ht-font-size-12px">
                    <div class="left">时间</div>
                    <div class="right right-bg-2">
                        {{ formatTime(item.created_at) }}
                    </div>
                </div>
                <div class="item ht-flex ht-font-size-12px">
                    <div class="left">访问</div>
                    <div class="right right-bg-3">{{ item.read_num }}</div>
                </div>
            </div>
            <article class="content">
                <Editor :text="item.content"></Editor>
            </article>
            <div class="footer ht-flex ht-row-center">
                <el-button size="small" @click="articleThumb(item.id)"
                    ><i class="iconfont icon-thumbs"></i>
                    {{ item.thumb_num }}</el-button
                >
            </div>
            <div class="up-down">
                <div class="item" v-if="upArticle != null">
                    <span @click="articleDetail(upArticle.id)">
                        上一篇：{{ upArticle.title }}</span
                    >
                </div>
                <div class="item" v-if="downArticle != null">
                    <span @click="articleDetail(downArticle.id)">
                        下一篇：{{ downArticle.title }}</span
                    >
                </div>
            </div>
            <div class="other ht-basebg ht-flex">
                <div class="left">
                    <img src="../assets/img/qqgroup.jpg" alt="" />
                </div>
                <div class="right">
                    <div class="">
                        <span>作者：</span>
                        <span>{{ item.author }}</span>
                    </div>
                    <div class="">
                        <span>邮箱：</span>
                        <span>{{ item.email }}</span>
                    </div>
                    <div class="">
                        <span>链接：</span>
                        <span>
                            <a
                                :href="`${$host}v1${$route.path}?id=${$route.query.id}`"
                                target="_blank"
                                >{{
                                    `${$host}v1${$route.path}?id=${$route.query.id}`
                                }}</a
                            >
                        </span>
                    </div>
                    <div class="">
                        <span>扫码加入学习交流群</span>
                    </div>
                </div>
            </div>
            <Comment class="comment" :actionType="1"></Comment>
            <CommentList :list="list" @handleThumb="handleThumb"></CommentList>
        </div>
    </div>
</template>

<script>
import Comment from "@/components/template/Comment.vue";
import CommentList from "@/components/template/CommentList.vue";
import Editor from "@/components/template/Editor.vue";
import Loading from "@/components/template/Loading.vue";
import {
    articleDetail,
    CommentGet,
    articleThumb,
    CommentThumb,
} from "@/assets/api/api";
import { SwitchDate } from "@/assets/js/formatTime";
import { message } from "@/assets/js/message";

export default {
    name: "ArticleDetail",
    metaInfo: {
        title: "文章详情 - 分享技术，分享生活 - 糊涂博客",
        meta: [
            {
                name: "keyWords",
                content: "网页，后台，技术，文章",
            },
            {
                name: "description",
                content:
                    "博客个人博客网站,一位编程爱好者的成长地。记录工作、生活中的点点滴滴,不定期更新分享，也希望能够认识更多的朋友。",
            },
        ],
    },
    components: { Comment, CommentList, Editor, Loading },
    data() {
        return {
            detail: "",
            LoadingFlag: true,
            list: [],
            start: 1,
            pageSize: 15,
            total: 0,
            downArticle: [],
            upArticle: [],
        };
    },
    methods: {
        /**
         * 文章详情
         */
        articleDetail(id) {
            this.LoadingFlag = true;
            articleDetail({ id: id }).then((res) => {
                if (!res) {
                    return false;
                }
                if (res.data.length === 0) {
                    this.$router.push({
                        path: "/",
                    });
                    return;
                }
                document.title =
                    res.data[0].title + " - 分享技术，分享生活 - 糊涂博客";
                this.detail = res.data;
                this.upArticle = res.upArticle;
                this.downArticle = res.downArticle;
                this.LoadingFlag = false;

                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            });
        },
        /**
         * 文章点赞
         */
        articleThumb(id) {
            articleThumb({
                id: id,
            }).then((res) => {
                if (res) {
                    message(1000, "感谢您的支持！", false);
                    this.articleDetail(id);
                }
            });
        },
        /**
         * 留言列表
         */
        CommentGet() {
            CommentGet({
                article_id: this.$store.state.article_id,
                start: 0,
                pageSize: this.pageSize * this.start,
            }).then((res) => {
                if (res) {
                    this.list = res.data;
                    this.total = res.total;
                }
            });
        },
        /**
         * 评论点赞
         */
        handleThumb(params) {
            CommentThumb(params).then((res) => {
                if (res) {
                    message(1000, "感谢您的支持！", false);
                    this.CommentGet();
                }
            });
        },
        /**
         * 日期转换
         */
        formatTime(time) {
            return SwitchDate(Date.parse(new Date(time)) / 1000);
        },
    },
    created() {
        this.$store.commit("setMsgFlag", true);
        this.$store.commit("setArticleId", this.$route.query.id);
        this.articleDetail(this.$route.query.id);
        this.CommentGet();
        this.$bus.$on("handleScroll", () => {
            if (this.list.length < this.total) {
                this.start = this.start + 1;
                this.CommentGet();
            }
        });
    },
    // beforeDestroy() {
    //     this.$bus.$off("handleScroll");
    // },
};
</script>

<style lang="scss" scoped>
.article-detail {
    padding: 20px;
    border-radius: 5px;
    > .title {
        padding: 15px 0;
        text-align: center;
        margin-bottom: 10px;
    }
    > .statistics {
        .item {
            color: $ht-white;
            margin-right: 10px;
            div {
                padding: 3px 5px;
            }
            .left {
                border-radius: 3px 0 0 3px;
                background: #292929;
            }
            .right {
                border-radius: 0 3px 3px 0;
                display: flex;
                align-items: center;
            }
            .right-bg-1 {
                background: rgb(1, 173, 145);
            }
            .right-bg-2 {
                background: rgb(212, 61, 1);
            }
            .right-bg-3 {
                background: rgb(206, 187, 16);
            }
        }
    }
    > .content {
        padding: 20px 0;
        line-height: 150%;
    }

    > .footer {
        margin: 20px 0;
        button {
            @include ht-button($ht-theme);
        }
    }
    > .up-down {
        padding: 10px 0;
        .item {
            padding: 5px 0;
            cursor: pointer;
        }
    }
    > .other {
        margin: 20px 0;
        padding: 10px;
        border-left: 5px solid $ht-theme;
        border-radius: 5px;
        .left {
            margin-right: 10px;
            img {
                background: #fff;
                padding: 5px;
                height: 80px;
                width: 80px;
                border-radius: 5px;
            }
            @media (max-width: 400px) {
                img {
                    display: none;
                }
            }
        }
        .right {
            line-height: 160%;
            a {
                text-decoration: none;
            }
        }
    }
    > .comment {
        margin: 30px 0;
    }
}
</style>