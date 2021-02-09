<template>
    <div class="type">
        <el-tabs type="border-card">
            <el-tab-pane label="文章类别">
                <TypeArticleList></TypeArticleList>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import TypeArticleList from "@/components/template/TypeArticleList.vue";

export default {
    name: "TypeArticle",
    components: {
        TypeArticleList,
    },
};
</script>

<style>
</style>