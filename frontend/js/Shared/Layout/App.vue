<script setup>
import NavigationBar from "@/js/Shared/Components/NavigationBar.vue";
</script>

<template>
  <div class="h-full flex flex-col">
    <NavigationBar />
    <slot />
  </div>
</template>
