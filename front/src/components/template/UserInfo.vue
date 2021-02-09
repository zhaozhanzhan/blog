<template>
    <div class="userinfo app-card">
        <div class="item">
            <span><i class="iconfont icon-user"></i></span>
            <span>糊涂</span>
        </div>
        <div class="item">
            <span><i class="iconfont icon-directions"></i></span>
            <span>China·QingYuan</span>
        </div>

        <div class="item">
            <span><i class="iconfont icon-link"></i></span>
            <span
                ><a href="https://www.lpyhutu.cn" target="_blank"
                    >糊涂个人博客</a
                ></span
            >
        </div>
        <div class="item">
            <span><i class="iconfont icon-link"></i></span>
            <span
                ><a href="https://github.com/lpyhutu" target="_blank"
                    >Github</a
                ></span
            >
        </div>
        <div class="item">
            <span><i class="iconfont icon-mail"></i></span>
            <span
                ><a
                    href=" http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=1048672466@qq.com"
                    target="_blank"
                    >1048672466@qq.com</a
                ></span
            >
        </div>
        <div class="item">
            <el-button size="small" icon="iconfont icon-Feather1" @click="jump"
                >留言</el-button
            >
        </div>
    </div>
</template>

<script>
export default {
    name: "UserInfo",
    methods: {
        jump() {
            this.$router.push({
                path: "/message",
            });
        },
    },
};
</script>

<style lang="scss" scoped>
.userinfo {
    margin-bottom: 15px;
    .item {
        padding: 8px 0;
        span:first-child {
            margin-right: 10px;
        }
        a {
            text-decoration: none;
            &:hover {
                color: $ht-theme;
            }
        }
        button {
            @include ht-button($ht-theme);
            width: 100%;
            letter-spacing: 4px;
        }
    }
}
</style>