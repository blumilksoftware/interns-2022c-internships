<template>
    <div class="flex h-full overflow-hidden">
        <SideBar />
        <Users />
    </div>
  </template>
  
  <script setup>
    import SideBar from "./Components/AdminPanelLayout.vue"
  import Users from "./Components/AdminPanelUsersList.vue"
  </script>
  