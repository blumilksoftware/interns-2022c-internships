<template>
  <router-view />
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "App",
  computed: {
    ...mapGetters([
      "getCompanies",
      "getFilters",
      "getFaculties",
      "getDocuments",
      "getTags",
    ]),
  },
  methods: {
    ...mapActions([
      "setCompanies",
      "setFilters",
      "setFaculties",
      "setDocuments",
      "setTags",
    ]),
  },
  mounted() {
    this.setCompanies();
    this.setFilters();
    this.setFaculties();
    this.setDocuments();
    this.setTags();
  },
};
</script>
<style>
html::-webkit-scrollbar {
  width: 12px;
  background-color: #f5f5f5;
}

html::-webkit-scrollbar-thumb {
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  background-color: #babac0;
}
html::-webkit-scrollbar-thumb:hover {
  background-color: #a0a0a5;
}
</style>
