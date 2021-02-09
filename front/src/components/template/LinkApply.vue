<template>
    <div class="link-apply">
        <div class="item ht-flex ht-col-center">
            <div>站点名称：</div>
            <div>
                <el-input
                    v-model="title"
                    maxlength="30"
                    show-word-limit
                ></el-input>
            </div>
        </div>
        <div class="item ht-flex ht-col-center">
            <div>站点地址：</div>
            <div>
                <el-input
                    v-model="site"
                    maxlength="70"
                    show-word-limit
                ></el-input>
            </div>
        </div>
        <div class="item ht-flex ht-col-center">
            <div>联系邮箱：</div>
            <div>
                <el-input v-model="email" maxlength="40" show-word-limit>
                </el-input>
            </div>
        </div>
        <div class="item">
            <el-button size="small" @click="LinkApply">申请</el-button>
        </div>
    </div>
</template>

<script>
import { LinkApply } from "@/assets/api/api";
import { message } from "@/assets/js/message";
import { checkEmail, checkWebsite } from "@/assets/js/reg";

export default {
    name: "LinkApply",
    data() {
        return {
            title: "",
            site: "",
            email: "",
        };
    },
    methods: {
        LinkApply() {
            if (this.title === "") {
                message(1003, "请输入站点名称！");
                return false;
            }
            if (this.site === "") {
                message(1003, "请输入站点地址！");
                return false;
            }
            if (this.site === "") {
                message(1003, "请输入站点地址！");
                return false;
            }
            if (!checkWebsite(this.site)) {
                message(1003, "站点格式错误！");
                return false;
            }
            if (this.email === "") {
                message(1003, "请输入邮箱！");
                return false;
            }
            if (!checkEmail(this.email)) {
                message(1003, "邮箱格式错误！");
                return false;
            }
            LinkApply({
                title: this.title,
                site: this.site,
                email: this.email,
            }).then((res) => {
                if (res) {
                    message(1000, "申请成功，等待审核！");
                    this.clear();
                }
            });
        },
        clear() {
            this.title = "";
            this.site = "";
            this.email = "";
        },
    },
};
</script>

<style lang="scss" scoped>
.link-apply {
    padding: 20px 0;
    .item {
        margin-bottom: 20px;
        div:last-child {
            // mwidth: 300px;
            flex: 1;
            max-width: 300px;
        }
        button {
            @include ht-button($ht-theme);
        }
    }
}
</style>