<script setup>
  import SideBar from "./Components/AdminPanelLayout.vue"
  import Companies from "./Components/AdminPanelCompaniesList.vue"
import { Inertia } from "@inertiajs/inertia";
  defineProps({
    companies: Object,
    filter: Object,
  })
  function onFilterSelect (statusSelect){
    Inertia.get(
      route(route().current()),
      {
        status: statusSelect.value
      },
      {
        preserveState: true,
        replace: true,
        only: "companies",
      }
    );
  }
  </script>

<template>
    <div class="flex max-h-full h-fit overflow-hidden overflow-scroll-y ">
        <SideBar />
        <Companies 
        :companies="companies.data"
        :filter="filter"
        @statusSelect="onFilterSelect"
        class="h-full w-full" />
    </div>
    <Pagination class="m-auto mb-0 flex max-w-sm sticky border-slate-500" :links="companies.links" />
  </template>
