<template>
  <div id="courses">
    <select v-model="mychoice" name="Kierunek" id="">
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
      mychoice: null,
    };
  },
  methods: {},
};
</script>
