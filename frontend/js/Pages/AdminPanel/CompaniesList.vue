<template>
    <div class="flex max-h-full h-fit overflow-hidden overflow-scroll-y ">
        <SideBar />
        <Companies :companies="companies.data" class="h-full w-full" />
    </div>
    <Pagination class="m-auto mb-0 flex max-w-sm sticky border-slate-500" :links="companies.links" />
  </template>
  
  <script setup>
  import SideBar from "./Components/AdminPanelLayout.vue"
  import Companies from "./Components/AdminPanelCompaniesList.vue"
  defineProps({
    companies: Object,
  })
  </script>
  