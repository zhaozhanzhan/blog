<template>
    <div class="editor">
        <!-- <div class="markdown-body" v-html="handleText(text)" v-highlight></div> -->

        <mavon-editor
            :boxShadow="false"
            :toolbarsFlag="false"
            defaultOpen="preview"
            :subfield="false"
            codeStyle="androidstudio"
            v-model="text"
            ref="md"
            class="editor"
        />
    </div>
</template>

<script>
import { mavonEditor } from "mavon-editor";
// import marked from "marked";
// import { addCodeBtn } from "@/assets/js/mavon";
export default {
    name: "Editor",
    props: {
        text: {
            default: "",
            type: String,
        },
    },
    components: {
        mavonEditor,
    },
    // methods: {
    //     handleText(val) {
    //         return marked(val);
    //     },
    // },
    // mounted() {
    //     // hljs.highlightCode();
    //     this.$nextTick(() => {
    //         addCodeBtn();
    //     });
    // },
};
</script>
<style lang="scss">
@media (max-width: 400px) {
    .v-show-content {
        padding: 5px !important;
    }
}
.editor {
    color: #666666 !important;
    a {
        text-decoration: none !important;
    }
    pre {
        font-size: 15px !important;
        background: #384538 !important;
        color: #d1d2d2;
    }
    .hljs {
        background: rgb(40, 48, 40) !important;
    }
}
.v-note-wrapper {
    // position: fixed !important;
    z-index: 1 !important;
}
</style>
