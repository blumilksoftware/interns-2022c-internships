<script setup>
import Companies from "./Components/AdminPanelCompaniesList.vue";
import Pagination from "@/js/Shared/Components/PaginationList.vue";
import { Inertia } from "@inertiajs/inertia";
defineProps({
  companies: Object,
  filter: String,
});
function StatusSelected(statusSelect) {
  Inertia.get(
    route(route().current()),
    {
      status: statusSelect.value,
    },
    {
      preserveState: true,
      replace: true,
      only: ["companies"],
    }
  );
}
</script>
<script>
  import SideBar from "@/js/Shared/Layout/Admin.vue"
  import AppLayout from "@/js/Shared/Layout/App.vue"
  export default {
  layout: [AppLayout, SideBar],
  }
</script>


<template>
  <div class="flex flex-col h-full w-full overflow-hidden">
    <Companies
      :companies="companies.data"
      :filter="filter"
      class="h-full w-full"
      @selected="StatusSelected"
    />
    <Pagination
    class="m-auto mb-0 flex max-w-sm sticky mx-auto border-slate-500"
    :links="companies.meta.links"
  />
  </div>
  
</template>
