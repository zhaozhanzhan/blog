<template>
    <div class="editor">
        <mavon-editor
            :boxShadow="false"
            v-model="$store.state.editorVal"
            @imgAdd="imgAdd"
            codeStyle="agate"
            ref="md"
            class="editor"
        />
        <!-- @imgDel="imgDel" -->
    </div>
</template>

<script>
import { mavonEditor } from "mavon-editor";
import "mavon-editor/dist/css/index.css";

import { upload } from "@/assets/api/api";
export default {
    name: "Editor",
    data() {
        return {
            content: "",
        };
    },
    components: {
        mavonEditor,
    },
    methods: {
        imgAdd(pos, $file) {
            var formdata = new FormData();
            formdata.append("image", $file);
            upload(formdata).then((res) => {
                if (res) {
                    this.$refs.md.$img2Url(pos, res.data);
                }
            });
        },
        // imgDel(pos) {
        //     console.log(pos);
        //     // delFile({ filename: this.splitUrl(pos[0]) });
        // },
        splitUrl(str) {
            let arr = str.split(this.$api);
            return arr[1];
        },
    },
};
</script>

<style lang="scss" scoped>
.markdown-body {
    // width: 100vh !important;
    height: 100vh !important;
}
.editor {
    /* font-size: 16px !important; */
    a {
        text-decoration: none !important;
    }
    pre {
        background: #384538 !important;
        color: #d1d2d2;
    }
    .hljs {
        background: rgb(40, 48, 40) !important;
    }
}
</style>