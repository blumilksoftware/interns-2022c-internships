<script setup>
import SideBar from "./Components/AdminPanelLayout.vue";
import Users from "./Components/AdminPanelUsersList.vue";
import Pagination from "@/js/Shared/Components/PaginationList.vue";
import { Inertia } from "@inertiajs/inertia";
defineProps({
  users: Object,
  filter: String,
});
function UsersSearch(UsersSearch) {
  Inertia.get(
    route(route().current()),
    {
      search: UsersSearch.value,
    },
    {
      preserveState: true,
      replace: true,
      only: ["users"],
    }
  );
}
</script>

<template>
  <div class="flex max-h-full h-fit overflow-hidden">
    <SideBar />
    <Users :filter="filter" @selected="UsersSearch" :users="users.data" />
  </div>
  <Pagination
    class="m-auto mb-0 flex max-w-sm sticky mx-auto border-slate-500"
    :links="users.meta.links"
  />
</template>
