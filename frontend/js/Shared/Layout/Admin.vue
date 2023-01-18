<script setup>
import SideBar from "@/js/Pages/AdminPanel/Components/AdminPanelSideBar.vue";
</script>

<template>
  <div class="h-full overflow-hidden flex">
    <SideBar />
    <slot />
  </div>
</template>
