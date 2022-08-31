<script setup>
import MapDisplay from "./Components/MapDisplay.vue";
import CompanyList from "./Components/CompanyList.vue";
import CompanyListHeader from "./Components/CompanyListHeader.vue";
import Filter from "./Components/FilterDisclosure.vue";

defineProps({
  companies: Object,
  cities: Object,
  departments: Object,
});
</script>

<template>
  <div
    class="flex-col w-full mx-0 flex sm:flex-row-reverse h-full overflow-hidden"
  >
    <div class="flex bg-gray-200 w-full h-full max-h-full">
      <MapDisplay />
    </div>
    <div
      class="flex flex-col bg-gray-50 w-full h-1/2 md:w-3/5 lg:w-3/5 xl:w-2/5 sm:h-full"
    >
      <CompanyListHeader :companies="companies" />
      <Filter :departments="departments.data" :cities="cities.data" />
      <CompanyList class="h-full" :companies="companies.data" />
      <Pagination class="mt-6 mb-0 sticky" :links="companies.links" />
    </div>
  </div>
</template>
