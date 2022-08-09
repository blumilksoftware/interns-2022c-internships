<template>
  <router-view />
</template>

<script>
import { mapActions } from "vuex";
export default {
  name: "App",
  methods: {
    ...mapActions([
      "fetchCompanies",
      "fetchFilters",
      "fetchFaculties",
      "fetchDocuments",
      "fetchTags",
      "fetchCompaniesMerged",
    ]),
  },
  mounted() {
    this.fetchCompanies();
    this.fetchFilters();
    this.fetchFaculties();
    this.fetchDocuments();
    this.fetchTags();
    this.fetchCompaniesMerged();
  },
};
</script>
<style>
html::-webkit-scrollbar {
  width: 12px;
  background-color: var(--softBlue);
}

html::-webkit-scrollbar-thumb {
  border-radius: 10px;
  box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  background-color: #babac0;
}
html::-webkit-scrollbar-thumb:hover {
  background-color: #a0a0a5;
}
</style>
