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
    ListContainer: ListContainer,
  },
};
</script>

<style>
.container {
  display: grid;
  width: 100%;
  grid-template-columns: 1fr 1.7fr;
  grid-template-rows: 1fr;
  gap: 0px 0px;
  grid-template-areas: "listcontainer map";
  /* height: 600px; */
}
.listcontainer {
  grid-area: listcontainer;
}
.map {
  grid-area: map;
  /* height: 100%; */
}
</style>
