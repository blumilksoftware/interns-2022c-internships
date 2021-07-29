<template>
  <div id="cities">
    <select class="selector" v-model="myChoice" placeholder="City">
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
      myChoice: null,
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
