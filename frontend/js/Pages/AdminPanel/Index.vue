<script setup>
  import Info from "./Components/AdminPanelInfo.vue";
  defineProps({
    active: Number,
    created: Number,
    edited: Number,
    auth: Object,
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
  <div class="flex h-full w-full overflow-hidden">
    <Info :active="active" :created="created" :edited="edited" />
  </div>
</template>
