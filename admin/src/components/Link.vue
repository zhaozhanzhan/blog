<template>
    <div class="link">
        <el-tabs type="border-card">
            <el-tab-pane label="链接列表">
                <LinkList></LinkList>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import LinkList from "@/components/template/LinkList.vue";

export default {
    name: "Link",
    components: {
        LinkList,
    },
};
</script>

<style>
</style>