<template>
  <div id="cities">
    <select class="selector" v-model="selectedCity" placeholder="City">
      <option :value="null" disabled hidden>Miasto</option>
      <option value="Legnica">Legnica</option>
      <option value="Wrocław">Wrocław</option>
      <option value="Bogatynia">Bogatynia</option>
    </select>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selectedCity: null,
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
