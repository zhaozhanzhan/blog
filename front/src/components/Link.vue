<template>
    <div class="link">
        <div class="content ht-white">
            <Tip :title="'温馨提示'">
                <div slot="text">
                    1、本站欢迎交换友链，如果想和本站交换友情链接的，欢迎在此申请。<br />
                    2、网站内容健康积极向上,对网站收录量无要求。<br />
                    3、审核结果均以邮件形式通知，请输入常用有效邮箱。<br />
                    4、若无意外，在申请友链后24小时内完成审核并录入站点，如超时还未审核完成，请留言或者私信给我。
                </div>
            </Tip>
            <LinkApply></LinkApply>
            <Tip :title="'链接列表'"> </Tip>
            <LinkList></LinkList>
        </div>
    </div>
</template>

<script>
import Tip from "@/components/template/Tip.vue";
import LinkApply from "@/components/template/LinkApply.vue";
import LinkList from "@/components/template/LinkList.vue";
export default {
    metaInfo: {
        title: "友情链接 - 分享技术，分享生活 - 糊涂博客",
        meta: [
            {
                name: "keyWords",
                content: "网页，后台，技术，链接",
            },
            {
                name: "description",
                content:
                    "博客个人博客网站,一位编程爱好者的成长地。记录工作、生活中的点点滴滴,不定期更新分享，也希望能够认识更多的朋友。",
            },
        ],
    },
    name: "Link",
    components: {
        Tip,
        LinkApply,
        LinkList,
    },
    created() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    },
};
</script>

<style lang="scss" scoped>
.link {
    .content {
        padding: 20px;
    }
}
</style>