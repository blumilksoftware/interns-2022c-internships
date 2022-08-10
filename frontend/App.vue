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
