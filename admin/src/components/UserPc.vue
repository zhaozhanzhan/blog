<template>
    <div class="user-pc">
        <el-tabs type="border-card">
            <el-tab-pane label="PC用户">
                <UserPcList></UserPcList>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import UserPcList from "@/components/template/UserPcList.vue";

export default {
    name: "UserPC",
    components: {
        UserPcList,
    },
};
</script>

<style>
</style>