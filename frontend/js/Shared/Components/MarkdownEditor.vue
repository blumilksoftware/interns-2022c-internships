<script setup>
import { ref } from "vue";
import MdEditor from "md-editor-v3";
import "md-editor-v3/lib/style.css";
import dompurify from "dompurify";

const sanitize = (html) =>
  dompurify.sanitize(html, {
    USE_PROFILES: { html: false },
    ADD_TAGS: [
      "strong",
      "em",
      "h1",
      "h2",
      "h3",
      "h4",
      "h5",
      "h6",
      "p",
      "a",
      "br",
      "blockquote",
    ],
    ADD_ATTR: ["href"],
  });
const text = ref("# Hello Editor");
const props = defineProps({
  toolbarOptions: {
    Array,
    default: [
      "bold",
      "italic",
      "title",
      "quote",
      "link",
      "pageFullscreen",
      "preview",
    ],
  },
  previewTheme: { String, default: "github" },
});

MdEditor.config({
  editorConfig: {
    languageUserDefined: {
      "key.translated": {
        toolbarTips: {
          bold: "----",
        },
        linkModalTips: {
          title: "Add ",
          descLable: "Desc:",
          descLablePlaceHolder: "Enter a description...",
          urlLable: "Link:",
          UrlLablePlaceHolder: "Enter a link...",
          buttonOK: "OK",
        },
        footer: {
          markdownTotal: "Word Count",
          scrollAuto: "Scroll Auto",
        },
      },
    },
  },
});
</script>

<template>
  <md-editor
    language="key.translated"
    :previewTheme="props.previewTheme"
    :toolbars="props.toolbarOptions"
    :sanitize="sanitize"
    v-model="text"
  />
</template>
