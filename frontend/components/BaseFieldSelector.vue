<template>
  <select>
    <option value="" selected disabled hidden>{{ name }}</option>
    <option v-for="data in dataGiven" :key="data">{{ data.name }}</option>
  </select>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true,
    },
    dataGiven: {
      type: Array,
      required: true,
    },
  },
};
</script>
