<template>
    <div class="tip">
        <div class="title ht-basebg">
            {{ title }}
        </div>
        <div class="text">
            <slot name="text"></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "Tip",
    props: {
        title: String,
    },
    created() {
        // console.log(111)
    },
};
</script>

<style lang="scss" scoped>
.tip {
    >.title {
        font-weight: bold;
        // font-size: 15px;
        padding: 10px;
        border-left: 5px solid $ht-theme;
        // &::before {
        //     content: " ";
        //     position: absolute;
        //     -webkit-border-radius: 50%;
        //     border-radius: 50%;
        //     background: #fc625d;
        //     width: 12px;
        //     height: 12px;
        //     -webkit-box-shadow: 20px 0 #fdbc40, 40px 0 #35cd4b;
        //     box-shadow: 20px 0 #fdbc40, 40px 0 #35cd4b;
        // }
    }
    > .text {
        padding-top: 10px;
        line-height: 200%;
    }
}
</style>