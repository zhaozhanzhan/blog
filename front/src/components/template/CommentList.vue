<template>
    <div class="CommentList">
        <div class="item ht-flex" v-for="(item, key) in list" :key="key">
            <div class="avatar ht-flex">
                <img :src="item.avatar" alt="" />
                <div class="triangle"></div>
            </div>
            <div class="right">
                <div class="top ht-basebg">
                    <div class="user">
                        <span class="name">
                            <span style="color: #ee4e03">{{
                                item.master === 1 ? "站长" : ""
                            }}</span>
                            {{ item.name }}
                        </span>
                        <span class="time">{{
                            formatTime(item.created_at)
                        }}</span>
                    </div>
                    <div
                        class="text"
                        v-html="processEmotion(item.content)"
                    ></div>
                </div>
                <div class="bottom ht-flex">
                    <div
                        class="reply"
                        :ref="`reply-${key}`"
                        @click="replyCommentFlag(key, null)"
                    >
                        回复
                    </div>
                    <div class="thumb" @click="handleThumb(item.id, 0, true)">
                        点赞 {{ item.thumb_num }}
                    </div>
                </div>
                <Comment
                    class="comment"
                    :subData="{ msg_id: item.id }"
                    :actionType="2"
                ></Comment>
                <div
                    class="item-two"
                    v-for="(itemTwo, keyTwo) in item.msg_sub"
                    :key="keyTwo"
                >
                    <div class="right">
                        <div class="top ht-basebg">
                            <div class="user">
                                <span class="name">
                                    <span>
                                        <span style="color: #ee4e03">{{
                                            itemTwo.master === 1 ? "站长" : ""
                                        }}</span>
                                        {{ itemTwo.name }}</span
                                    >
                                    <span>
                                        @
                                        <span style="color: #ee4e03">{{
                                            itemTwo.be_master === 1
                                                ? " 站长 "
                                                : ""
                                        }}</span
                                        >{{ itemTwo.be_name }}</span
                                    >
                                </span>
                                <span class="time">{{
                                    formatTime(itemTwo.created_at)
                                }}</span>
                            </div>
                            <div
                                class="text"
                                v-html="processEmotion(itemTwo.content)"
                            ></div>
                        </div>
                        <div class="bottom ht-flex">
                            <div
                                class="reply"
                                :ref="`reply-${key}-${keyTwo}`"
                                @click="replyCommentFlag(key, keyTwo)"
                            >
                                回复
                            </div>
                            <div
                                class="thumb"
                                @click="handleThumb(item.id, itemTwo.id, false)"
                            >
                                点赞 {{ itemTwo.thumb_num }}
                            </div>
                        </div>
                        <Comment
                            class="comment"
                            :subData="{ subId: itemTwo.id }"
                            :actionType="3"
                        ></Comment>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Comment from "@/components/template/Comment.vue";
import { SwitchTimeSlot } from "@/assets/js/formatTime";
import { processEmotion } from "@/assets/js/changeEmotion";

export default {
    name: "CommentList",
    components: {
        Comment,
    },
    props: {
        list: Array,
    },
    methods: {
        handleThumb(id, subId) {
            this.$emit("handleThumb", { id, subId });
        },
        /**
         * 日期转换
         */
        formatTime(time) {
            return SwitchTimeSlot(Date.parse(new Date(time)));
        },
        /**
         * 表情
         */
        processEmotion(text) {
            return processEmotion(text);
        },
        replyCommentFlag(key, keyTwo) {
            let keyVal = "";
            if (keyTwo === null) {
                keyVal = `reply-${key}`;
            } else {
                keyVal = `reply-${key}-${keyTwo}`;
            }
            let { display } = this.$refs[
                keyVal
            ][0].parentElement.nextElementSibling.style;
            if (display === "" || display === "none") {
                this.$refs[
                    keyVal
                ][0].parentElement.nextElementSibling.style.display = "block";
                this.$refs[keyVal][0].innerText = "取消回复";
            } else {
                this.$refs[
                    keyVal
                ][0].parentElement.nextElementSibling.style.display = "none";
                this.$refs[keyVal][0].innerText = "回复";
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.CommentList {
    .item {
        margin-bottom: 20px;
        > .avatar {
            padding-top: 5px;
            height: 50px;
            width: 50px;
            img {
                height: 40px;
                width: 40px;
                border-radius: 5px;
            }
            .triangle {
                width: 0;
                height: 0;
                border-top: 20px solid transparent;
                border-right: 20px solid $ht-basebg;
                border-bottom: 20px solid transparent;
            }
        }
        > .right {
            flex: 1;
            > .top {
                padding: 5px;
                border-radius: 5px;
                > .user {
                    .name {
                        font-weight: bold;
                        padding-right: 5px;
                    }
                    .time {
                        color: #999;
                    }
                }
                > .text {
                    display: flex;
                    padding: 10px 0 5px 0;
                    line-height: 160%;
                }
            }
            > .bottom {
                margin-bottom: 10px;
                > div {
                    padding: 4px;
                    border-radius: 5px;
                    cursor: pointer;
                    color: $ht-minor-color;
                }

                > .reply {
                    margin-right: 10px;
                }
                > .thumb {
                }
            }
            > .comment {
                display: none;
            }
            .item-two {
                > .right {
                    flex: 1;
                    > .top {
                        padding: 5px;
                        border-radius: 5px;
                        > .user {
                            .name {
                                font-weight: bold;
                                padding-right: 5px;
                                span:last-child {
                                    color: $ht-theme;
                                }
                            }
                            .time {
                                color: #999;
                            }
                        }
                        > .text {
                            padding: 5px 0;
                            line-height: 160%;
                        }
                    }
                    > .bottom {
                        margin-bottom: 10px;
                        div {
                            padding: 4px;
                            border-radius: 5px;
                            cursor: pointer;
                            color: $ht-minor-color;
                        }

                        > .reply {
                            margin-right: 10px;
                        }
                        > .thumb {
                        }
                    }
                    > .comment {
                        display: none;
                    }
                }
            }
        }
    }
}
</style>