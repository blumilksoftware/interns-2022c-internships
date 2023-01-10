<script setup>
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
<script>
import SideBar from "@/js/Shared/Layout/Admin.vue";
import AppLayout from "@/js/Shared/Layout/App.vue";
export default {
  layout: [AppLayout, SideBar],
};
</script>
<template>
  <div class="flex h-full flex-col w-full overflow-hidden">
    <Users :filter="filter" @selected="UsersSearch" :users="users.data" />
    <Pagination
      class="m-auto mb-0 flex max-w-sm sticky mx-auto border-slate-500"
      :links="users.meta.links"
    />
  </div>
</template>
