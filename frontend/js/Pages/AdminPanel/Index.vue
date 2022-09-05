<template>
  <div class="flex h-full overflow-hidden">
    <SideBar />
    <Info :active="active" :created="created" :edited="edited" />
  </div>
</template>

<script setup>
import SideBar from "./Components/AdminPanelLayout.vue";
import Info from "./Components/AdminPanelInfo.vue";
defineProps({
  active: Number,
  created: Number,
  edited: Number,
  auth: Object,
});
</script>
