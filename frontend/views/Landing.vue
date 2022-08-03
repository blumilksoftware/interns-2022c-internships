<template>
  <div class="wrapper">
    <SelectFaculty />
    <JoinUs />
    <StoriesSection />
  </div>
</template>

<script>
import SelectFaculty from "@/components/SelectFacultySection.vue";
import JoinUs from "@/components/JoinUsSection.vue";
import StoriesSection from "@/components/StoriesSection.vue";

export default {
  components: {
    SelectFaculty,
    JoinUs,
    StoriesSection,
  },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  max-width: 1500px;
  margin: 0 auto;
}
</style>
