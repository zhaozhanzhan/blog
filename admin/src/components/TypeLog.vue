<template>
    <div class="type">
        <el-tabs type="border-card">
            <el-tab-pane label="日志类别">
                <TypeLogList></TypeLogList>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import TypeLogList from "@/components/template/TypeLogList.vue";

export default {
    name: "TypeLog",
    components: {
        TypeLogList,
    },
};
</script>

<style>
</style>