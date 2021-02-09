<template>
    <div class="article">
        <div
            class="item ht-white"
            v-for="(item, key) in articleList"
            :key="key"
        >
            <div
                class="title ht-font-size-18px"
                @click="articleDetail(item.id)"
            >
                {{ item.title }}
            </div>
            <div class="text ht-font-size-14px">摘要：{{ item.content }}</div>
            <div class="footer ht-flex ht-row-between ht-col-center">
                <div class="left ht-font-size-12px ht-minor-color">
                    <span> posted @</span>
                    <span>{{ formatTime(item.created_at) }}</span>
                    <span>{{ item.author }}</span>
                    <span>阅读（{{ item.read_num }}）</span>
                    <span
                        >评论（{{
                            item.front_comment.length +
                            item.front_comment_sub.length
                        }}）</span
                    >
                    <span>点赞（{{ item.thumb_num }}）</span>
                </div>
                <div class="right" @click="articleDetail(item.id)">
                    阅读详情
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { SwitchDate } from "@/assets/js/formatTime";

export default {
    name: "ArticleItem",
    props: {
        articleList: {
            type: Array,
        },
    },
    methods: {
        articleDetail(id) {
            this.$router.push({
                path: "/article-detail",
                query: {
                    id: id,
                },
            });
        },
        /**
         * 日期转换
         */
        formatTime(time) {
            return SwitchDate(Date.parse(new Date(time)) / 1000);
        },
    },
};
</script>

<style lang="scss" scoped>
.article {
    .item {
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 15px;
        > .title {
            // font-weight: bold;
            margin-bottom: 15px;
            @include line-clamp(2);
            &:hover {
                cursor: pointer;
                color: $ht-theme;
            }
        }
        > .text {
            line-height: 200%;
            margin-bottom: 15px;
            overflow: hidden;
            white-space: normal;
            word-wrap: break-word;
            word-break: break-all;
            text-overflow: ellipsis;
            @include line-clamp(3);
        }
        > .footer {
            .left {
                span {
                    margin-right: 5px;
                }
            }
            .right {
                border-bottom: 2px solid $ht-font-color;
                padding: 3px;
                &:hover {
                    cursor: pointer;
                    color: $ht-theme;
                    border-bottom: 2px solid $ht-theme;
                }
            }
        }
    }
}
</style>