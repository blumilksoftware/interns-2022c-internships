<template>
  <div class="h-full flex flex-col">
    <NavigationBar />
    <slot />
  </div>
</template>

<script setup>
import NavigationBar from "@/js/Shared/Components/NavigationBar.vue";
</script>
