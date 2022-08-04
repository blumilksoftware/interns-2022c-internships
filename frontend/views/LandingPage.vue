<template>
  <div class="wrapper">
    <SelectFaculty />
    <StoriesSection />
  </div>
</template>

<script>
import SelectFaculty from "@/components/SelectFacultySection.vue";
import StoriesSection from "@/components/StoriesSection.vue";

export default {
  components: {
    SelectFaculty,
    StoriesSection,
  },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>

<style lang="pcss" scoped>
.wrapper {
  max-width: 1500px;
  margin: 0 auto;
}
</style>
