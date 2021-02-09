<template>
    <div class="link-list ht-flex ht-wrap">
        <a
            :href="item.site"
            v-for="(item, key) in $store.state.LinkList"
            :key="key"
            target="_blank"
            @click="LinkVisitNum(item.id)"
        >
            <div class="item">{{ item.title }}</div></a
        >
    </div>
</template>

<script>
import { LinkVisitNum } from "@/assets/api/api";
export default {
    name: "LinkList",
    methods: {
        LinkVisitNum(id) {
            LinkVisitNum({ id: id });
        },
    },
};
</script>

<style lang="scss" scoped>
.link-list {
    margin-top: 15px;
    a {
        color: #fff;
        text-decoration: none;
        margin: 0 10px 10px 0;
        .item {
            padding: 10px;
            background: $ht-theme;
            border-radius: 5px;
        }
    }
}
</style>