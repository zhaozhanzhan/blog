<template>
    <div class="article-hot app-card">
        <div class="title">
            <div class="left left-1"></div>
            <div class="left left-2"></div>
            <div class="left left-3"></div>
            <div class="right">阅读排行</div>
        </div>
        <div class="content">
            <div
                class="item ht-font-size-14px"
                v-for="(item, key) in readingRankingList"
                :key="key"
                @click="articleDetail(item.id)"
            >
                {{ key + 1 }}.{{ item.title.substring(0, 30)
                }}{{ handleTitleLenght(item.title) ? "..." : "" }}({{
                    item.read_num
                }})
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ArticleHot",
    props: {
        readingRankingList: Array,
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
        handleTitleLenght(val) {
            if (val.length > 30) {
                return true;
            }
            return false;
        },
    },
};
</script>

<style lang="scss" scoped>
.article-hot {
    margin-bottom: 15px;
    .content {
        .item {
            margin-bottom: 10px;
            line-height: 170%;
            cursor: pointer;

            &:hover {
                color: $ht-theme;
            }
        }
    }
}
</style>