<template>
  <CompanyBrowser />
</template>

<script>
import CompanyBrowser from "@/components/CompanyBrowser.vue"

export default {
  components: {
    CompanyBrowser
    },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>
