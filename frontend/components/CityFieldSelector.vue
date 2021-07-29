<template>
  <div id="cities">
    <select class="selector" v-model="chosenCity" placeholder="City">
      <option :value="null" disabled hidden>Miasto</option>
      <option v-for="city in cities" :key="city">{{ city.name }}</option>
      >
    </select>
  </div>
</template>

<script>
export default {
  data() {
    return {
      chosenCity: null,
      cities: [
        {
          name: "Wrocław",
        },
        {
          name: "Legnica",
        },
        {
          name: "Lubin",
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
