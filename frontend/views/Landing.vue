<template>
  <div class="wrapper">
    <SelectFaculty />
    <JoinUs />
    <StoriesSection />
  </div>
</template>

<script>
import SelectFaculty from "@/components/SelectFacultySection";
import JoinUs from "@/components/JoinUsSection";
import StoriesSection from "@/components/StoriesSection";

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
