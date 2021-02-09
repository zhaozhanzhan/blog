<template>
    <div class="app-index">
        <Header></Header>
        <Banner :total="total"></Banner>
        <div class="app-content ht-flex">
            <div class="left">
                <UserInfo></UserInfo>
                <LinkRecommend class="hidden"></LinkRecommend>
                <QRCode class="hidden"></QRCode>
            </div>
            <div class="right">
                <router-view></router-view>
            </div>
        </div>
        <Footer></Footer>
        <el-backtop></el-backtop>
    </div>
</template>

<script>
import Header from "@/components/template/Header.vue";
import Banner from "@/components/template/Banner.vue";
import Footer from "@/components/template/Footer.vue";
import UserInfo from "@/components/template/UserInfo.vue";
import LinkRecommend from "@/components/template/LinkRecommend.vue";
import QRCode from "@/components/template/QRCode.vue";
import {
    LinkGet,
    InfoGet,
    userLogin,
    totalVisitsTime,
    totalNum,
} from "@/assets/api/api";

export default {
    name: "App",
    components: {
        Header,
        Footer,
        Banner,
        UserInfo,
        LinkRecommend,
        QRCode,
    },
    data() {
        return {
            total: {},
        };
    },
    methods: {
        /**
         * 访问
         */
        userLogin() {
            userLogin().then((res) => {
                if (res) {
                    this.$cookies.set("isLogin", res.time);
                }
            });
        },
        /**
         * 链接列表
         */
        LinkGet() {
            LinkGet().then((res) => {
                if (res) {
                    this.$store.commit("setLinkList", res.data);
                }
            });
        },
        /**
         * 基本信息
         */
        InfoGet() {
            InfoGet().then((res) => {
                if (res) {
                    const { data } = res;
                    this.$store.commit("setInfoDetail", data[0]);
                }
            });
        },
        /**
         * 统计
         */
        totalNum() {
            totalNum().then((res) => {
                if (res) {
                    this.total = res.data;
                }
            });
        },
        /**
         * 浏览时长
         */
        addVisitsTime() {
            totalVisitsTime();
            this.$store.commit("setVisitsTime", 60);
            this.visitsTime();
        },

        visitsTime() {
            if (this.$store.state.visitsTime > 0) {
                setTimeout(() => {
                    this.$store.commit(
                        "setVisitsTime",
                        this.$store.state.visitsTime - 1
                    );
                    this.visitsTime();
                }, 1000);
                return;
            }
            this.addVisitsTime();
        },
        handlePercent(val) {
            this.$store.commit("setProgress", val);
            if (val >= 0.999) {
                this.$bus.$emit("handleScroll", true);
            }
        },
        handleScrolltop() {
            const _this = this;
            window.addEventListener("scroll", function () {
                let scrollTop =
                    window.pageYOffset ||
                    document.documentElement.scrollTop ||
                    document.body.scrollTop;
                let { scrollHeight } =
                    document.documentElement || document.body;
                let { clientHeight } = document.documentElement;
                _this.handlePercent(scrollTop / (scrollHeight - clientHeight));
            });
        },
    },
    created() {
        if (!this.$cookies.isKey("isLogin")) {
            this.userLogin();
        }
        this.LinkGet();
        this.InfoGet();
        this.addVisitsTime();
        this.totalNum();
        // index().then((res) => {
        //     console.log(res);
        // });
    },
    mounted() {
        this.handleScrolltop();
    },
};
</script>

<style>
</style>
