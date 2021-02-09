<template>
    <div class="statistics">
        <el-tabs type="border-card">
            <el-tab-pane label="数据统计">
                <TotalList></TotalList>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import TotalList from "@/components/template/TotalList.vue";

export default {
    name: "statistics",
    components: {
        TotalList,
    },
};
</script>
