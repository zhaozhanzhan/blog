<template>
    <div class="header ht-white">
        <div class="content ht-flex ht-col-center ht-row-between">
            <div class="left ht-flex ht-col-center">
                <div class="logo ht-flex ht-row-center">
                    <img src="../../assets/img/logo.png" alt="" />
                </div>
                <div class="nav ht-flex">
                    <div
                        class="item"
                        :class="
                            $route.path === item.path ? 'ht-active-router' : ''
                        "
                        v-for="(item, key) in navList"
                        :key="key"
                        @click="jump(item.path, false)"
                    >
                        <i class="iconfont" :class="item.icon"></i>
                        {{ item.title }}
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="hamburger" @click="handelHamburger">
                    <i class="iconfont icon-hanbaocaidanzhedie"></i>
                </div>
                <!-- <el-input class="search" placeholder="Search..." size="medium">
                    <el-button slot="append" icon="el-icon-search"></el-button>
                </el-input> -->
            </div>
        </div>
        <div ref="nav" class="nav" :class="navShadow">
            <div
                class="item ht-white"
                :class="$route.path === item.path ? 'ht-active-router' : ''"
                v-for="(item, key) in navList"
                :key="key"
                @click="jump(item.path, true)"
            >
                <i class="iconfont" :class="item.icon"></i> {{ item.title }}
            </div>
        </div>
        <div
            class="progress"
            :style="{ width: `${$store.state.progress * 100}%` }"
        ></div>
    </div>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            navShadow: "",
            progress: 0,
            navList: [
                { title: "首页", path: "/home", icon: "icon-home" },

                { title: "留言", path: "/message", icon: "icon-comment" },
                { title: "友链", path: "/link", icon: "icon-link" },
                {
                    title: "应用中心",
                    path: "/file",
                    icon: "icon-folder-open",
                },
                { title: "关于", path: "/about", icon: "icon-user" },
            ],
        };
    },
    methods: {
        // 跳转
        jump(path, flag) {
            this.$router.push({
                path: path,
            });
            if (flag) {
                this.handelHamburger();
            }
        },
        // 汉堡
        handelHamburger() {
            if (
                this.$refs.nav.style.height === "" ||
                this.$refs.nav.style.height === "0px"
            ) {
                let { childNodes } = this.$refs.nav;
                this.$refs.nav.style.height = `${
                    childNodes[0].clientHeight * childNodes.length
                }px`;
                this.navShadow = "nav-shadow";
            } else {
                this.$refs.nav.style.height = "0px";
                this.navShadow = "";
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.header {
    position: fixed;
    width: 100%;
    top: 0px;
    height: 60px;
    z-index: 1000;

    .content {
        max-width: 1200px;
        margin: auto;
        height: 100%;
        > .left {
            flex: 1;
            .logo {
                width: 100px;
                img {
                    width: 50px;
                    height: 50px;
                }
            }
            .nav {
                font-size: 15px;
                flex: 1;
                .item {
                    cursor: pointer;
                    margin-right: 30px;

                    // font-weight: bold;
                }
            }
        }
        > .right {
            width: 230px;
            .hamburger {
                display: none;
            }
        }
    }
    > .nav {
        @include ht-transition(0.4s);
        height: 0px;
        overflow: hidden;
        // border-top: 1px solid #f3f3f3;
        .item {
            padding: 13px 30px;
        }
    }
    > .nav-shadow {
        box-shadow: 5px 9px 5px rgba(0, 0, 0, 0.07);
    }
    .progress {
        height: 2px;
        width: 20%;
        background: $ht-active-router;
    }
}
@media (max-width: 767px) {
    .header {
        > .content {
            > .left {
                .logo {
                    width: 80px;
                }
                .nav {
                    display: none;
                }
            }
            > .right {
                width: 70px;
                .search {
                    display: none;
                }
                .hamburger {
                    text-align: center;
                    line-height: 25px;
                    width: 35px;
                    height: 30px;
                    display: block;
                    border: 1px solid #eee;
                    border-radius: 3px;
                    &:hover {
                        background: #dbdbdb;
                        cursor: pointer;
                    }
                }
            }
        }
    }
}
</style>