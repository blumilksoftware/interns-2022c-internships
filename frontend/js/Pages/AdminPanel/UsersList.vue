<template>
    <div class="flex h-full overflow-hidden">
        <SideBar />
        <Users :users="users.data"/>
    </div>
    <Pagination class="m-auto mb-0 flex max-w-sm sticky border-slate-500" :links="users.links" />
  </template>
  
  <script setup>
    import SideBar from "./Components/AdminPanelLayout.vue"
  import Users from "./Components/AdminPanelUsersList.vue"
  defineProps({
    users: Object,
  })
  </script>
  