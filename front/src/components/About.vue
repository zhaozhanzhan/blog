<template>
    <div class="about">
        <div><Editor :text="$store.state.infoDetail.content"></Editor></div>
    </div>
</template>

<script>
import Editor from "@/components/template/Editor.vue";
export default {
    name: "About",
    metaInfo: {
        title: "关于我 - 分享技术，分享生活 - 糊涂博客",
        meta: [
            {
                name: "keyWords",
                content: "网页，后台，技术、踩坑",
            },
            {
                name: "description",
                content:
                    "博客个人博客网站,一位编程爱好者的成长地。记录工作、生活中的点点滴滴,不定期更新分享，也希望能够认识更多的朋友。",
            },
        ],
    },
    components: {
        Editor,
    },
    created() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    },
};
</script>

<style lang="scss" scoped>
.about {
    background: #fff;
    > div {
        padding: 10px;
    }
}
</style>