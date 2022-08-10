<template>
  <div class="home">
    <NavigationBar />
    <MapList class="maplist fixed" />
  </div>
</template>

<script>
import NavigationBar from "@/components/NavigationBar.vue";
import MapList from "@/components/MapList.vue";

export default {
  components: {
    NavigationBar,
    MapList,
  },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>
