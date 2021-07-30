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
};
</script>

<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");

.wrapper {
  max-width: 1500px;
  margin: 0 auto;
}
</style>
