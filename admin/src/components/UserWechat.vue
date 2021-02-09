<template>
    <div class="user-wechat">
        <el-tabs type="border-card">
            <el-tab-pane label="WeChat用户">
                <UserWechatList></UserWechatList>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import UserWechatList from "@/components/template/UserWechatList.vue";

export default {
    name: "UserWechat",
    components: {
        UserWechatList,
    },
};
</script>

<style>
</style>