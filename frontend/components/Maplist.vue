<template>
  <div class="container">
    <ListContainer class="listcontainer" />
    <Map class="map" />
  </div>
</template>
<script>
import Map from "./Map.vue";
import ListContainer from "./ListContainer.vue";

export default {
  components: {
    Map: Map,
    ListContainer,
  },
};
</script>

<style lang="scss" scoped>
.container {
  display: grid;
  width: 100%;
  grid-template-columns: 1fr 1.4fr;
  grid-template-rows: 1fr;
  gap: 0px 0px;
  grid-template-areas: "listcontainer map";

  @media (orientation: portrait) {
    grid-template-columns: 1fr;
    grid-template-rows: 70vh auto;
    grid-template-areas:
      "map"
      "listcontainer";
  }
  .listcontainer {
    grid-area: listcontainer;
    background-color: rgb(243, 246, 248);
  }
  .map {
    grid-area: map;
  }
}
</style>
