<template>
  <div class="container">
    <ListContainer class="listcontainer bg-gray-100" />
    <MapDisplay class="map h-full" />
  </div>
</template>
<script>
import MapDisplay from "./MapDisplay.vue";
import ListContainer from "./ListContainer.vue";

export default {
  components: {
    MapDisplay,
    ListContainer,
  },
};
</script>
