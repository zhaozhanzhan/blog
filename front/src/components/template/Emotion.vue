<template>
    <div class="emotion">
        <div class="icon">
            <i
                class="iconfont icon-Ovalx"
                @click="emotionFlag = !emotionFlag"
            ></i>
        </div>
        <div class="box ht-basebg" v-show="emotionFlag">
            <img
                class="box-item"
                v-for="(item, key) in emotionArr"
                :key="key"
                :src="item.url"
                :alt="item.name"
                @click="handleEmotion(item.name)"
            />
        </div>
    </div>
</template>

<script>
import { emotionList } from "@/assets/js/emotionList";
export default {
    name: "Emotion",
    data() {
        return {
            emotionArr: [],
            emotionFlag: false,
        };
    },
    methods: {
        loadEmotion() {
            emotionList.map((item, index) => {
                this.emotionArr.push({
                    name: `#${item};`,
                    url: `https://api.lpyhutu.cn/HtBlog/public/upload/img/emotion/${index}.gif`,
                });
            });
        },
        handleEmotion(name) {
            this.emotionFlag = false;
            this.$emit("handleEmotion", name);
        },
    },
    created() {
        this.loadEmotion();
    },
};
</script>

<style lang="scss" scoped>
.emotion {
    position: relative;
    .icon {
        i {
            padding: 5px;
            border-radius: 3px;
            cursor: pointer;
            color: $ht-theme;
        }
    }
    .box {
        position: absolute;
        bottom: 25px;
        min-width: 280px;
        border-radius: 5px;
        box-shadow: 0 0 10px #eee;
        padding: 5px;
        .box-item {
            padding: 3px;
            cursor: pointer;
        }
    }
}
</style>