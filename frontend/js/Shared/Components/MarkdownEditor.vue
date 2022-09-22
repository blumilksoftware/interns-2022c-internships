<script setup>
import { ref } from "vue";
import MdEditor from "md-editor-v3";
import "md-editor-v3/lib/style.css";
import dompurify from "dompurify";
import { useI18n } from "vue-i18n";

const i18n = useI18n();

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
      "ul",
      "ol",
      "li",
    ],
    ADD_ATTR: ["href", "target"],
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
    ],
  },
  previewTheme: { String, default: "github" },
});

MdEditor.config({
  editorConfig: {
    languageUserDefined: {
      "key.translated": {
        toolbarTips: {
          bold: i18n.t("markdown.bold"),
          italic: i18n.t("markdown.italic"),
          quote: i18n.t("markdown.quote"),
          link: i18n.t("markdown.link"),
          pageFullscreen: i18n.t("markdown.fullscreen"),
          preview: i18n.t("markdown.preview"),
        },
        titleItem: {
          h1: i18n.t("markdown.h1"),
          h2: i18n.t("markdown.h2"),
          h3: i18n.t("markdown.h3"),
          h4: i18n.t("markdown.h4"),
          h5: i18n.t("markdown.h5"),
          h6: i18n.t("markdown.h6"),
        },
        linkModalTips: {
          title: i18n.t("markdown.linkAdd"),
          descLable: i18n.t("markdown.linkDescription"),
          descLablePlaceHolder: i18n.t("markdown.enterLinkDescription"),
          urlLable: i18n.t("markdown.linkLabel"),
          UrlLablePlaceHolder: i18n.t("markdown.enterLink"),
          buttonOK: i18n.t("markdown.ok"),
        },
        footer: {
          markdownTotal: i18n.t("markdown.letterCount"),
          scrollAuto: i18n.t("markdown.scrollAuto"),
        },
      },
    },
  },
  markedRenderer(renderer) {
    renderer.link = (href, title, text) => {
      return `<a href="${href}" target="_blank">${text}</a>`;
    };

    return renderer;
  }
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

<style>
    #md-editor-v3-preview {
    word-break: normal !important;
    text-align: justify;
  }
</style>