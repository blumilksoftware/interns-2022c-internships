<script setup>
  import SideBar from "./Components/AdminPanelLayout.vue"
  import Companies from "./Components/AdminPanelCompaniesList.vue"
  import Pagination from "@/js/Shared/Components/PaginationList.vue";
import { Inertia } from "@inertiajs/inertia";
  defineProps({
    companies: Object,
    filter: String,
  })
  function StatusSelected(statusSelect){
    Inertia.get(
      route(route().current()),
      {
        status: statusSelect.value,
      },
      {
        preserveState: true,
        replace: true,
        only: ["companies"]
      }
    )
  }

  </script>

<template>
    <div class="flex max-h-full h-fit overflow-hidden">
        <SideBar />
        <Companies 
        :companies="companies.data"
        :filter="filter"
        class="h-full w-full"
        @selected="StatusSelected" />
    </div>
    <Pagination class="m-auto mb-0 flex max-w-sm sticky border-slate-500" :links="companies.meta.links" />
  </template>
