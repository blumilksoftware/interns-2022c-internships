<template>
  <div class="home">
    <Nav class="sticky" />
    <Maplist class="maplist" />
    <informations class="info" />
    <Files class="files" />
    <Regulations class="margin-horizontal margin-vertical reg" />
    <Cooperate />
  </div>
</template>

<script>
import Navi from "./Nav.vue";
import Coop from "./Cooperate.vue";
import Info from "./Informations.vue";
import Files from "./Files.vue";
import Regulations from "./Regulations.vue";
import Maplist from "./Maplist.vue";

export default {
  components: {
    Nav: Navi,
    Cooperate: Coop,
    Informations: Info,
    Files: Files,
    Regulations: Regulations,
    Maplist: Maplist,
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
  max-width: 100vw;
}
.margin-horizontal {
  max-width: 800px;
  margin: 0 auto;
}

.margin-vertical {
  margin-top: 60px;
  margin-bottom: 60px;
}

.info {
  margin-bottom: 50px;
}

.files {
  max-width: 400px;
  margin: 80px auto 0 auto;
}
</style>
