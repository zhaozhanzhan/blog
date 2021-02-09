<template>
    <div class="message ht-flex ht-row-between">
        <Loading v-show="LoadingFlag" :tip="$store.state.blackTip"></Loading>
        <div class="content ht-white">
            <Tip :title="'温馨提示'">
                <div slot="text">
                    1、欢迎大家在这留言或提意见建议。<br />
                    2、留言内容要健康积极向上，不得刷评论、发表不良信息。<br />
                    3、如果发现某些功能不能使用，请联系邮箱 1048672466@qq.com。
                </div>
            </Tip>
            <Comment class="comment" :actionType="1"></Comment>
            <CommentList :list="list" @handleThumb="handleThumb"></CommentList>
        </div>
    </div>
</template>

<script>
import Tip from "@/components/template/Tip.vue";
import Comment from "@/components/template/Comment.vue";
import CommentList from "@/components/template/CommentList.vue";
import Loading from "@/components/template/Loading.vue";
import { MsgGet, MsgThumb } from "@/assets/api/api";
import { message } from "@/assets/js/message";

export default {
    name: "Messages",
    metaInfo: {
        title: "留言板 - 分享技术，分享生活 - 糊涂博客",
        meta: [
            {
                name: "keyWords",
                content: "网页，后台，技术，留言",
            },
            {
                name: "description",
                content:
                    "博客个人博客网站,一位编程爱好者的成长地。记录工作、生活中的点点滴滴,不定期更新分享，也希望能够认识更多的朋友。",
            },
        ],
    },
    components: { Tip, Comment, CommentList, Loading },
    data() {
        return {
            LoadingFlag: true,
            isLoadingFlag: true,
            list: [],
            start: 1,
            pageSize: 15,
            total: 0,
        };
    },
    methods: {
        /**
         * 留言列表
         */
        MsgGet() {
            this.LoadingFlag = this.isLoadingFlag ? true : false;
            MsgGet({
                start: 0,
                pageSize: this.pageSize * this.start,
            }).then((res) => {
                if (res) {
                    this.list = res.data;
                    this.total = res.total;
                    this.LoadingFlag = false;
                }
            });
        },
        /**
         * 留言点赞
         */
        handleThumb(params) {
            MsgThumb(params).then((res) => {
                if (res) {
                    message(1000, "感谢您的支持！", false);
                    this.isLoadingFlag = false;
                    this.MsgGet();
                }
            });
        },
    },
    created() {
        this.$store.commit("setMsgFlag", false);
        this.MsgGet();
        this.$bus.$on("handleScroll", () => {
            if (this.list.length < this.total) {
                this.start = this.start + 1;
                this.isLoadingFlag = true;
                this.MsgGet();
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
.message {
    .content {
        flex: 1;
        padding: 20px;
        border-radius: 5px;
        .comment {
            padding: 30px 0 50px;
        }
    }
}
</style>