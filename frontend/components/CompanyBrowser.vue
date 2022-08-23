<template>
  <div
    class="flex-col w-full mx-0 flex md:flex-row-reverse h-full overflow-hidden"
  >
    <div class="flex bg-gray-200 w-full h-full max-h-full">
      <!-- <MapDisplay /> -->
    </div>
    <div
      class="flex flex-col bg-gray-50 w-full md:h-full h-1/2 md:w-3/5 lg:w-3/5 xl:w-2/5 sm:h-full"
    >
      <CompanyListHeader />
      <CompanyList />
    </div>
  </div>
</template>

<script setup>
import MapDisplay from "@/components/MapDisplay.vue";
import CompanyList from "@/components/CompanyList.vue";
import CompanyListHeader from "@/components/CompanyListHeader.vue";
</script>
