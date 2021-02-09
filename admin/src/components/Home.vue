<template>
    <div class="home">
        <el-container>
            <el-aside width="200px"><Menu></Menu></el-aside>
            <el-container>
                <el-header class="ht-white"> <Header></Header></el-header>
                <el-main class="ht-basebg">
                    <router-view></router-view>
                </el-main>
                <el-footer
                    class="ht-white ht-font-size-12px ht-flex ht-row-center ht-col-center"
                >
                    Copyright © 2020-2021 hutu [adm.lpyhutu.cn] All Rights
                    Reserved</el-footer
                >
            </el-container>
        </el-container>
    </div>
</template>

<script>
import Menu from "@/components/template/Menu.vue";
import Header from "@/components/template/Header.vue";

export default {
    name: "Home",
    components: { Menu, Header },
};
</script>

<style lang="scss" scoped>
.home {
    height: 100%;
    width: 100%;
}
</style>
<style>
.el-container {
    height: 100%;
}
.el-header {
    height: 50px !important;
    border-bottom: 1px solid #eee;
    padding: 0px !important;
}
.el-aside {
    background-color: #404040;
}
.el-footer {
    border-top: 1px solid #eee;
    height: 30px !important;
}
.el-main {
    padding: 15px !important;
}
</style>