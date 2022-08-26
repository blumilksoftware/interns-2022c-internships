<template>
  <div
    class="shadow ring-1 ring-black ring-opacity-5 md:rounded-lg overflow-x-hidden overflow-y-scroll"
  >
    <div class="mb-1" v-for="company in companies" :key="company.id">
      <CompanyTile
        :name="company.name"
        :city="company.address.city"
        :image="PlaceholderImage"
        :description="company.description"
      />
    </div>
  </div>
</template>

<script setup>
import PlaceholderImage from "@/assets/images/blumilklogo.png";
import CompanyTile from "./CompanyTile.vue";

defineProps({
  companies: Object,
});
</script>
