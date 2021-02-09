<template>
    <div class="QRCode">
        <el-divider>扫码交流</el-divider>
        <div class="content ht-flex ht-row-around">
            <img src="../../assets/img/QRCode.jpg" alt="微信" />
            <img src="../../assets/img/WeChat.jpg" alt="小程序" />
        </div>
    </div>
</template>

<script>
export default {
    name: "QRCode",
};
</script>

<style lang="scss" scoped>
.QRCode {
    width: 100%;
    .content {
        img {
            width: 40%;
            height: 40%;
        }
    }
    .el-divider__text {
        background: #f4f4f4 !important;
    }
}
</style>