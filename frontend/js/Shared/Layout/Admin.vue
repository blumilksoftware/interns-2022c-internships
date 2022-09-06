<script setup>
import SideBar from "@/js/Shared/Components/AdminPanelSideBar.vue";
</script>

<template>
  <div class="h-full flex">
    <SideBar />
    <slot />
  </div>
</template>
