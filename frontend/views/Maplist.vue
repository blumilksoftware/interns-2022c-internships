<template>
  <div class="container">
    <div class="listcontainer">LISTA</div>
    <div class="map">MAPA</div>
  </div>
</template>

<style>
.container {
  display: grid;
  width: 100vw;
  grid-template-columns: 1fr 1.7fr;
  grid-template-rows: 1fr;
  gap: 0px 0px;
  grid-template-areas: "listcontainer map";
}
.listcontainer {
  grid-area: listcontainer;
  background: red;
}
.map {
  grid-area: map;
  background: blue;
}
</style>
