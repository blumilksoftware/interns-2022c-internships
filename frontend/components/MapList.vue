<template>
  <div class="container">
    <ListContainer class="listcontainer bg-gray-100" />
    <MapDisplay class="map" />
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

<style lang="pcss" scoped>
.container {
  display: grid;
  width: 100%;
  grid-template-columns: 0.8fr 1.5fr;
  grid-template-rows: 1fr;
  gap: 0px 0px;
  grid-template-areas: "listcontainer map";

  @media (orientation: portrait) {
    grid-template-columns: 1fr;
    grid-template-rows: 75vh auto;
    grid-template-areas:
      "map"
      "listcontainer";
  }
  .listcontainer {
    grid-area: listcontainer;
  }
  .map {
    grid-area: map;
  }
}
</style>
