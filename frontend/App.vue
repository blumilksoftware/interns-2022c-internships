<template>
<div class="relative min-h-full flex flex-col">
  <NavigationBar/>
  <router-view />
</div>
</template>

<script>
import NavigationBar from "@/components/NavigationBar.vue";

export default {
  name: "App",
  components: {
    NavigationBar,
},
};
</script>
