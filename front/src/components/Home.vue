<template>
    <div class="home ht-flex ht-row-between">
        <Loading v-show="LoadingFlag" :tip="$store.state.blackTip"></Loading>
        <div class="left">
            <ArticleItem :articleList="articleList"></ArticleItem>
        </div>
        <div class="right">
            <ArticleHot :readingRankingList="readingRankingList"></ArticleHot>
            <MessageNew :msgNewList="msgNewList"></MessageNew>
        </div>
    </div>
</template>

<script>
import ArticleItem from "@/components/template/ArticleItem.vue";
import ArticleHot from "@/components/template/ArticleHot.vue";
import MessageNew from "@/components/template/MessageNew.vue";
import Loading from "@/components/template/Loading.vue";
import { articleGet, MsgGet } from "@/assets/api/api";
export default {
    metaInfo: {
        title: "分享技术，分享生活 - 糊涂博客",
        meta: [
            {
                name: "keyWords",
                content: "网页，后台，技术，分享",
            },
            {
                name: "description",
                content:
                    "博客个人博客网站,一位编程爱好者的成长地。记录工作、生活中的点点滴滴,不定期更新分享，也希望能够认识更多的朋友。",
            },
        ],
    },
    name: "Home",
    data() {
        return {
            LoadingFlag: true,
            articleList: [],
            readingRankingList: [],
            msgNewList: [],
            start: 1,
            pageSize: 10,
            total: 0,
        };
    },
    components: {
        Loading,
        ArticleItem,
        ArticleHot,
        MessageNew,
    },
    methods: {
        /**
         * 文章列表
         */
        articleGet() {
            this.LoadingFlag = true;
            articleGet({
                start: 0,
                pageSize: this.pageSize * this.start,
            }).then((res) => {
                if (res) {
                    this.LoadingFlag = false;
                    this.articleList = res.data;
                    this.total = res.total;
                    this.readingRankingList = res.readingRanking;
                }
            });
        },
        /**
         * 最新留言
         */
        MsgGet() {
            MsgGet({
                start: 0,
                pageSize: 10,
            }).then((res) => {
                if (res) {
                    this.msgNewList = res.data;
                }
            });
        },
    },
    created() {
        this.articleGet();
        this.MsgGet();
        this.$bus.$on("handleScroll", () => {
            if (this.articleList.length < this.total) {
                this.start = this.start + 1;
                this.articleGet();
            }
        });
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    },
    // beforeDestroy() {
    //     this.$bus.$off("handleScroll");
    // },
};
</script>

<style lang="scss" scoped>
.home {
    .left {
        flex: 3;
        padding-right: 15px;
    }
    .right {
        flex: 1.3;
    }
}
@media (max-width: 767px) {
    .home {
        flex-flow: column;
        .left {
            .recommend {
                display: none;
            }
        }
    }
}
@media (max-width: 991px) {
    .home {
        .left {
            padding: 0;
        }
        .right {
            display: none;
        }
    }
}
</style>