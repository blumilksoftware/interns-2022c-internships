<template>
  <div id="cities">
    <select class="selector" v-model="myChoice" placeholder="City">
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
      myChoice: null,
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
