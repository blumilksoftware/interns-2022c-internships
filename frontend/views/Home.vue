<template>
  <div class="home">
    <Nav class="sticky" />
    <div class="maplist">MAPLIST</div>
    <informations />
    <Files class="margin" />
    <Regulations class="margin" />
    <Cooperate />
  </div>
</template>

<script>
import Navi from "./Nav.vue";
import Coop from "./Cooperate.vue";
import Info from "./Informations.vue";
import Files from "./Files.vue";
import Regulations from "./Regulations.vue";

export default {
  components: {
    Nav: Navi,
    Cooperate: Coop,
    Informations: Info,
    Files: Files,
    Regulations: Regulations,
  },
};
</script>

<style>
.sticky {
  position: fixed;
  top: 0;
  width: 100%;
  background-color: white;
  z-index: 100;
}
.maplist {
  margin-top: 64px;
}
.margin {
  max-width: 800px;
  margin: 0 auto;
}
</style>
