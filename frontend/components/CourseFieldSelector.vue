<template>
  <div id="courses">
    <select class="selector" v-model="selectedCourse" name="Kierunek">
      <option :value="null" disabled hidden>Kierunek</option>
      <option value="Informatyka">Informatyka</option>
      <option value="Grafika">Grafika</option>
      <option value="Ekonomia">Ekonomia</option>
    </select>
  </div>
</template>

<script>
export default {
  el: "#courses",
  data() {
    return {
      selectedCourse: null,
    };
  },
  methods: {},
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
