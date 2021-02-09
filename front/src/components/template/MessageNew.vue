<template>
    <div class="message-new app-card">
        <div class="title">
            <div class="left left-1"></div>
            <div class="left left-2"></div>
            <div class="left left-3"></div>
            <div class="right">最新留言</div>
        </div>
        <div class="content">
            <div
                class="item ht-flex ht-font-size-12px"
                v-for="(item, key) in msgNewList"
                :key="key"
            >
                <div class="left">
                    <img :src="item.avatar" alt="" />
                </div>
                <div class="right ht-flex ht-flow-column">
                    <div class="user">
                        <span>{{ item.name }}</span>
                        <span>{{ formatTime(item.created_at) }}</span>
                    </div>
                    <div class="text" v-html="processEmotion(item.content)">
                        <!-- {{ item.content }} -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { SwitchTimeSlot } from "@/assets/js/formatTime";
import { processEmotion } from "@/assets/js/changeEmotion";

export default {
    name: "MessageNew",
    props: {
        msgNewList: Array,
    },
    methods: {
        /**
         * 日期转换
         */
        formatTime(time) {
            return SwitchTimeSlot(Date.parse(new Date(time)));
        },
        /**
         * 表情
         */ processEmotion(text) {
            return processEmotion(text);
        },
    },
};
</script>

<style lang="scss" scoped>
.message-new {
    .content {
        .item {
            line-height: 190%;
            margin-bottom: 15px;
            .left {
                min-width: 35px;
                height: 35px;

                img {
                    height: 35px;
                    width: 35px;
                    border-radius: 100%;
                }
            }
            .right {
                flex: 1;
                padding: 0 5px;
                .user {
                    margin-bottom: 5px;
                    span:first-child {
                        padding-right: 10px;
                        font-weight: bold;
                    }
                }
                .text {
                    flex: 1;
                    padding: 3px 5px;
                    background: $ht-basebg;
                    border-radius: 5px;
                    @include line-clamp(2);
                }
            }
        }
    }
}
</style>