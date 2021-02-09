<template>
    <div class="comment">
        <el-tabs type="border-card" @tab-click="handleTab" v-model="tabsName">
            <el-tab-pane label="全部" name="all">
                <CommentList ref="all"></CommentList>
            </el-tab-pane>
            <el-tab-pane label="已审核" name="normal">
                <CommentList ref="normal"></CommentList>
            </el-tab-pane>
            <el-tab-pane label="待审核" name="hidden">
                <CommentList ref="hidden"></CommentList>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import CommentList from "@/components/template/CommentList.vue";

export default {
    name: "comment",
    data() {
        return {
            tabsName: "all",
        };
    },
    components: {
        CommentList,
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