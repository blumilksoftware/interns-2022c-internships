<template>
    <div class="flex h-full overflow-hidden">
        <SideBar />
        <Companies />
    </div>
  </template>
  
  <script setup>
    import SideBar from "./Components/AdminPanelLayout.vue"
  import Companies from "./Components/AdminPanelCompaniesList.vue"
  </script>
  