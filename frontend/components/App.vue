<template>
  <div class="h-full flex flex-col">
    <NavigationBar />
    <router-view />
  </div>
</template>

<script setup>
import NavigationBar from "@/components/NavigationBar.vue";
</script>
