<template>
    <div class="link-recommend app-card">
        <div class="title">
            <div class="left left-1"></div>
            <div class="left left-2"></div>
            <div class="left left-3"></div>
            <div class="right">链接推荐</div>
        </div>
        <div class="content">
            <div
                class="item ht-flex ht-col-center ht-row-between ht-font-size-14px"
                v-for="(item, key) in $store.state.LinkList"
                :key="key"
            >
                <div class="left ht-flex">
                    <div class="img">{{ item.title.slice(0, 1) }}</div>
                    <div class="info ht-flex ht-flow-column ht-row-between">
                        <a
                            :href="item.site"
                            class="title"
                            target="_blank"
                            @click="LinkVisitNum(item.id)"
                        >
                            {{ item.title }}
                        </a>
                        <div class="ht-font-size-12px visits">
                            {{ item.visit_num }}·次访问
                        </div>
                    </div>
                </div>
                <a
                    :href="item.site"
                    class="right"
                    target="_blank"
                    @click="LinkVisitNum(item.id)"
                    >访问</a
                >
            </div>
        </div>
    </div>
</template>

<script>
import { LinkVisitNum } from "@/assets/api/api";

export default {
    name: "LinkRecommend",
    methods: {
        LinkVisitNum(id) {
            LinkVisitNum({ id: id });
        },
    },
};
</script>

<style lang="scss" scoped>
.link-recommend {
    .content {
        > .item {
            margin-bottom: 20px;
            a {
                text-decoration: none;
            }
            .left {
                .img {
                    color: #fff;
                    font-size: 18px;
                    background: $ht-theme;
                    height: 35px;
                    min-width: 35px;
                    border-radius: 5px;
                    line-height: 35px;
                    text-align: center;
                }
                .info {
                    padding-left: 10px;
                    .title {
                        @include line-clamp(1);
                        cursor: pointer;
                    }
                    .visits {
                        color: $ht-minor-color;
                    }
                }
            }
            .right {
                width: 60px;
                text-align: right;
                color: $ht-theme;
                cursor: pointer;
                // &:hover {
                // }
            }
        }
    }
}
</style>