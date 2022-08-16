<template>
  <!-- 3 column wrapper -->
  <div
    class="flex-col w-full mx-0 flex md:flex-row-reverse max-h-full overflow-hidden"
  >
    <div class="flex bg-red-500 w-full h-full max-h-full">
      <MapDisplay />
    </div>
    <div
      class="flex flex-col bg-gray-200 w-full md:h-full h-1/2 md:w-3/5 lg:w-3/5 xl:w-2/5 max-h-full"
    >
      <CompanyListHeader />
      <CompanyList />
    </div>
  </div>
</template>

<script setup>
import MapDisplay from "./MapDisplay.vue";
import CompanyList from "./CompanyList.vue";
import CompanyListHeader from "./CompanyListHeader.vue";
</script>
