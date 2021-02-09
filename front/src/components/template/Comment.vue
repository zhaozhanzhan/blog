<template>
    <div class="comment">
        <div class="user ht-flex">
            <div class="avatar">
                <img
                    :src="
                        $store.state.avatar == ''
                            ? require('../../assets/img/avatar.png')
                            : $store.state.avatar
                    "
                    alt=""
                />
            </div>
            <div class="item">
                <el-input
                    placeholder="请输入QQ号"
                    v-model="$store.state.qq"
                    @change="qqInfo"
                ></el-input>
            </div>
            <div class="item">
                <el-input
                    placeholder="昵称（自动获取）"
                    disabled
                    v-model="$store.state.name"
                >
                </el-input>
            </div>
            <div class="item email">
                <el-input
                    placeholder="邮箱（自动获取）"
                    disabled
                    v-model="$store.state.email"
                ></el-input>
            </div>
        </div>
        <div class="text">
            <el-input
                type="textarea"
                placeholder="说点什么好呢"
                rows="6"
                maxlength="150"
                v-model="content"
            ></el-input>
        </div>
        <div class="footer ht-flex ht-row-between">
            <div class="emotion-btn">
                <Emotion @handleEmotion="handleEmotion"></Emotion>
            </div>
            <div class="send-out">
                <i class="iconfont icon-send" @click="confirm"></i>
            </div>
        </div>
    </div>
</template>

<script>
import Emotion from "@/components/template/Emotion.vue";
import {
    qqInfo,
    MsgAdd,
    MsgSubComment,
    MsgSubCommentSub,
    CommentAdd,
    CommentSubComment,
    CommentSubCommentSub,
} from "@/assets/api/api";
import { message } from "@/assets/js/message";
import { checkQQ } from "@/assets/js/reg";
export default {
    name: "Comment",
    components: { Emotion },
    props: {
        actionType: Number,
        subData: Object,
    },
    data() {
        return {
            qq: "",
            email: "",
            nickName: "",
            avatar: "",
            content: "",
        };
    },
    methods: {
        confirm() {
            if (this.$store.state.msgFlag) {
                this.comment();
            } else {
                this.message();
            }
        },
        /**
         * 留言
         */
        message() {
            if (this.actionType === 1) {
                this.MsgAdd();
            } else if (this.actionType === 2) {
                this.MsgSubComment();
            } else {
                this.MsgSubCommentSub();
            }
        },
        /**
         * 文章评论
         */
        comment() {
            if (this.actionType === 1) {
                this.CommentAdd();
            } else if (this.actionType === 2) {
                this.CommentSubComment();
            } else {
                this.CommentSubCommentSub();
            }
        },
        /**
         * 留言
         */
        MsgAdd() {
            if (!this.checkInput()) {
                return;
            }
            MsgAdd({
                qq: this.$store.state.qq,
                name: this.$store.state.name,
                email: this.$store.state.email,
                avatar: this.$store.state.avatar,
                content: this.content,
            }).then((res) => {
                if (res) {
                    message(1000, "评论成功，等待审核！");
                    this.content = "";
                }
            });
        },
        /**
         * 留言评论
         */
        MsgSubComment() {
            if (!this.checkInput()) {
                return;
            }
            MsgSubComment({
                msg_id: this.subData.msg_id,
                qq: this.$store.state.qq,
                name: this.$store.state.name,
                email: this.$store.state.email,
                avatar: this.$store.state.avatar,
                content: this.content,
            }).then((res) => {
                if (res) {
                    message(1000, "评论成功，等待审核！");
                    this.content = "";
                }
            });
        },
        /**
         * 子留言评论
         */
        MsgSubCommentSub() {
            if (!this.checkInput()) {
                return;
            }
            MsgSubCommentSub({
                subId: this.subData.subId,
                qq: this.$store.state.qq,
                name: this.$store.state.name,
                email: this.$store.state.email,
                avatar: this.$store.state.avatar,
                content: this.content,
            }).then((res) => {
                if (res) {
                    message(1000, "评论成功，等待审核！");
                    this.content = "";
                }
            });
        },
        /**
         * 文章留言
         */
        CommentAdd() {
            if (!this.checkInput()) {
                return;
            }
            CommentAdd({
                article_id: this.$store.state.article_id,
                qq: this.$store.state.qq,
                name: this.$store.state.name,
                email: this.$store.state.email,
                avatar: this.$store.state.avatar,
                content: this.content,
            }).then((res) => {
                if (res) {
                    message(1000, "评论成功，等待审核！");
                    this.content = "";
                }
            });
        },
        CommentSubComment() {
            CommentSubComment({
                msg_id: this.subData.msg_id,
                qq: this.$store.state.qq,
                name: this.$store.state.name,
                email: this.$store.state.email,
                avatar: this.$store.state.avatar,
                content: this.content,
            }).then((res) => {
                if (res) {
                    message(1000, "评论成功，等待审核！");
                    this.content = "";
                }
            });
        },
        CommentSubCommentSub() {
            CommentSubCommentSub({
                subId: this.subData.subId,
                qq: this.$store.state.qq,
                name: this.$store.state.name,
                email: this.$store.state.email,
                avatar: this.$store.state.avatar,
                content: this.content,
            }).then((res) => {
                if (res) {
                    message(1000, "评论成功，等待审核！");
                    this.content = "";
                }
            });
        },
        /**
         * 检查输入
         */
        checkInput() {
            if (
                this.$store.state.qq === "" ||
                this.$store.state.name === "" ||
                this.content === ""
            ) {
                message(1003, "说点什么好呢！");
                return false;
            }
            if (!checkQQ(this.$store.state.qq)) {
                message(1003, "QQ参数格式错误！");
                return false;
            }
            return true;
        },
        /**
         * qq信息
         */
        qqInfo() {
            if (!checkQQ(this.$store.state.qq)) {
                this.$store.commit("setQQ", "");
                message(1003, "QQ参数格式错误！", false);
                return false;
            }
            qqInfo({ qq: this.$store.state.qq }).then((res) => {
                if (res) {
                    const { email, nickName, avatar } = res.data;
                    this.$store.commit("setEmail", email);
                    this.$store.commit(
                        "setName",
                        nickName == "" ? this.$store.state.qq : nickName
                    );
                    this.$store.commit("setAvatar", avatar);
                }
            });
        },
        /**
         * 表情
         */
        handleEmotion(emotion) {
            this.content = this.content + emotion;
        },
    },
};
</script>

<style lang="scss" scoped>
.comment {
    padding: 15px;
    > .user {
        .avatar {
            margin-right: 10px;
            img {
                width: 40px;
                height: 40px;
                border-radius: 3px;
            }
        }
        .item {
            margin-right: 10px;
        }
    }
    > .text {
        padding: 15px 0 10px;
    }
    > .footer {
        i {
            cursor: pointer;
            color: $ht-theme;
            padding: 5px;
            border-radius: 3px;
        }
    }
}
@media (max-width: 767px) {
    .comment {
        > .user {
            .email {
                display: none;
            }
        }
    }
}
</style>