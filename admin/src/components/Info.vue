<template>
    <div class="info">
        <el-tabs type="border-card">
            <el-tab-pane label="基本信息">
                <InfoList></InfoList>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import InfoList from "@/components/template/InfoList.vue";

export default {
    name: "Info",
    components: {
        InfoList,
    },
};
</script>

<style>
</style>