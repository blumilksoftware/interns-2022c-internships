<template>
  <div class="wrapper">
    <SelectFaculty />
    <JoinUs />
    <StoriesSection />
  </div>
</template>

<script>
import SelectFaculty from "@/components/selectFacultySection";
import JoinUs from "@/components/joinUsSection";
import StoriesSection from "@/components/storiesSection";

export default {
  components: {
    SelectFaculty,
    JoinUs,
    StoriesSection,
  },
};
</script>

<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");

.wrapper {
  max-width: 1500px;
  margin: 0 auto;
}
</style>
