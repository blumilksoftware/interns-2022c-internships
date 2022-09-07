<script setup>
import DeletedItems from "./Components/AdminPanelDeletedUsers.vue";
defineProps({
  users: Object,
});
</script>
<script>
    import SideBar from "@/js/Shared/Layout/Admin.vue"
    import AppLayout from "@/js/Shared/Layout/App.vue"
    export default {
    layout: [AppLayout, SideBar],
    }
  </script>

<template>
    <div class="flex flex-col w-full max-h-full overflow-hidden">
      <DeletedItems :users="users.data" class="max-h-full overflow-hidden" />

    </div>
</template>