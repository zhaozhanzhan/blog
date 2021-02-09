<template>
    <div
        class="footer ht-white ht-flex ht-row-center ht-flow-column ht-col-center ht-font-size-12px"
    >
        <div>{{$store.state.infoDetail.copyright}}</div>
        <a
            :href="$store.state.infoDetail.record_link"
            target="_blank"
            class="record ht-flex"
        >
            <div class="left">备案号</div>
            <div class="right">
                {{ $store.state.infoDetail.record }}
            </div>
        </a>
    </div>
</template>

<script>
export default {
    name: "Footer",
};
</script>

<style lang="scss" scoped>
.footer {
    margin-top: 20px;
    padding: 10px 0;
    > div {
        padding-bottom: 6px;
    }
    .record {
        text-decoration: none;
        div {
            padding: 3px;
            color: #fff;
        }
        .left {
            border-radius: 3px 0 0 3px;
            background: #000;
        }
        .right {
            border-radius: 0 3px 3px 0;
            background: $ht-theme;
        }
    }
}
</style>