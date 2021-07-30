<template>
  <div id="courses">
    <select class="selector" v-model="selectedCourse" name="Kierunek">
      <option :value="null" disabled hidden>Kierunek</option>
      <option v-for="course in courses" :key="course">{{ course.name }}</option>
    </select>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selectedCourse: null,
      courses: [
        {
          name: "Informatyka",
        },
        {
          name: "Grafika",
        },
        {
          name: "Ekonomia",
        },
      ],
    };
  },
};
</script>

<style lang="scss" scoped>
@import "../assets/styles/_variables";

.selector {
  border-color: $darkGreyColor;
  @media (orientation: portrait) {
    width: 100%;
  }
}
</style>
