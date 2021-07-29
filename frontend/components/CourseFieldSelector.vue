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

<style scoped>
@media (orientation: portrait) {
  .selector {
    width: 100%;
  }
}
</style>
