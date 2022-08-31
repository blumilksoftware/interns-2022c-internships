<template>
  <div
    class="shadow ring-1 ring-black ring-opacity-5 md:rounded-lg overflow-x-hidden overflow-y-scroll"
  >
    <div class="mb-1" v-for="company in companies" :key="company.id">
      <CompanyTile :company="company" />
    </div>
  </div>
</template>

<script setup>
import CompanyTile from "./CompanyTile.vue";

defineProps({
  companies: Array,
});
</script>
