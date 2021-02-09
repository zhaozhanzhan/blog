<template>
    <div class="type">
        <el-tabs type="border-card">
            <el-tab-pane label="更新日志">
                <LogList></LogList>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import LogList from "@/components/template/LogList.vue";
export default {
    name: "TypeLog",
    components: {
        LogList,
    },
    data() {
        return {
            tabsName: 0,
        };
    },
};
</script>

<style>
</style>