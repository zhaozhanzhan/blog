<template>
    <div class="message">
        <el-tabs type="border-card" @tab-click="handleTab" v-model="tabsName">
            <el-tab-pane label="全部" name="all">
                <MessageList ref="all"></MessageList>
            </el-tab-pane>
            <el-tab-pane label="已审核" name="normal">
                <MessageList ref="normal"></MessageList>
            </el-tab-pane>
            <el-tab-pane label="待审核" name="hidden">
                <MessageList ref="hidden"></MessageList>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
import MessageList from "@/components/template/MessageList.vue";

export default {
    name: "Message",

    data() {
        return {
            tabsName: "all",
        };
    },
    components: {
        MessageList,
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