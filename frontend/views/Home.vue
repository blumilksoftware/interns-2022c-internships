<template>
  <div class="home">
    <Nav class="sticky" />
    <Maplist class="maplist" />
    <informations class="info" />
    <Files class="files" />
    <Cooperate class="cooperate" />
  </div>
</template>

<script>
import Navi from "../components/Nav.vue";
import Coop from "../components/Cooperate.vue";
import Info from "../components/Informations.vue";
import Files from "../components/Files.vue";
import Maplist from "../components/Maplist.vue";

export default {
  components: {
    Nav: Navi,
    Cooperate: Coop,
    Informations: Info,
    Files: Files,
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
  max-height: 80vh;
  z-index: 5;
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
  max-width: 80%;
  /* margin-bottom: 50px; */
  margin: 0px auto 50px auto;

  z-index: 4;
}

.files {
  max-width: 700px;
  margin: 50px auto 100px auto;
  z-index: 3;
}
.regulations {
  z-index: 2;
}

.cooperate {
  z-index: 1;
}
</style>
