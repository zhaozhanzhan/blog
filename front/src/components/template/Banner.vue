<template>
    <div class="banner">
        <div class="img"></div>
        <div class="number ht-flex ht-white">
            <div class="content ht-flex ht-row-between ht-col-center">
                <div class="left ht-font-size-12px">
                    <div>
                        {{ $store.state.infoDetail.title }}
                    </div>
                    <div>
                        {{ $store.state.infoDetail.english }}
                    </div>
                </div>
                <div class="right ht-flex ht-font-size-12px">
                    <div class="item">
                        <div>{{ total.article_num }}</div>
                        <div>文章</div>
                    </div>
                    <div class="item">
                        <div>{{ total.visitsInterval }}</div>
                        <div>访问量</div>
                    </div>
                    <div class="item">
                        <div>{{ online }}</div>
                        <div>在线人数</div>
                    </div>
                    <div class="item">
                        <div>{{ handleRunningTime() }}</div>
                        <div>运行天数</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { runningTime } from "@/assets/js/formatTime";
export default {
    name: "Banner",
    props: {
        total: Object,
    },
    data() {
        return {
            online: 0,
        };
    },
    methods: {
        handleRunningTime() {
            return runningTime(Date.now());
        },
        initWebSocket() {
            // this.websock = new WebSocket("ws://127.0.0.1:2346");
            this.websock = new WebSocket(this.$wss);
            this.websock.onmessage = this.websocketonmessage;
            this.websock.onopen = this.websocketonopen;
            this.websock.onerror = this.websocketonerror;
            this.websock.onclose = this.websocketclose;
        },
        websocketonopen() {
            this.websocketsend(
                JSON.stringify({
                    type: "front",
                    group: "front_login",
                    // uid: this.$cookies.get("token"),
                })
            );
        },
        websocketonerror() {
            this.initWebSocket();
        },
        websocketonmessage(e) {
            let data = JSON.parse(e.data);
            if (data.type == "online") {
                // console.log(data)
                this.online = data.data.online;
                // this.$store.commit("setOnline", data.data.online);
            }
        },
        websocketsend(Data) {
            this.websock.send(Data);
        },
    },
    created() {
        this.initWebSocket();
    },
};
</script>

<style lang="scss" scoped>
.banner {
    margin-top: 60px;
    line-height: 150%;
    > .img {
        height: 300px;
        background-image: url("../../assets/img/banner.jpg");
        background-size: cover;
    }
    > .number {
        min-height: 50px;
        .content {
            height: 100%;
            flex: 1;
            margin: auto;
            max-width: 1200px;
            padding: 10px 0;
            .left {
                padding: 0 10px;
            }
            .right {
                .item {
                    text-align: center;
                    padding: 0 10px;
                }
            }
        }
    }
}
@media (max-width: 767px) {
    .banner {
        > .number {
            .content {
                padding: 10px 0;
                flex-flow: column;
                .left {
                    order: 3;
                    text-align: center;
                    margin: 15px;
                }
                .right {
                    order: 2;
                }
            }
        }
    }
}
</style>