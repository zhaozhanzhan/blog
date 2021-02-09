<template>
    <div class="article">
        <el-tabs type="border-card" @tab-click="handleTab" v-model="tabsName">
            <el-tab-pane label="全部" name="all">
                <ArticleList ref="all"></ArticleList>
            </el-tab-pane>
            <el-tab-pane label="已发布" name="normal">
                <ArticleList ref="normal"></ArticleList>
            </el-tab-pane>
            <el-tab-pane label="待发布" name="hidden">
                <ArticleList ref="hidden"></ArticleList>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import ArticleList from "@/components/template/ArticleList.vue";
export default {
    name: "Article",
    data() {
        return {
            tabsName: "all",
        };
    },
    components: {
        ArticleList,
    },
    methods: {
        handleTab() {
            if (this.tabsName === "all") {
                this.$refs.all.handleGetType(0);
            } else if (this.tabsName === "normal") {
                this.$refs.normal.handleGetType(1);
            } else {
                this.$refs.hidden.handleGetType(2);
            }
        },
    },
    mounted() {
        this.handleTab();
    },
};
</script>

<style>
</style>