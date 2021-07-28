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
import Nav from "../components/Nav";
import Cooperate from "../components/Cooperate";
import Informations from "../components/Informations";
import Files from "../components/Files";
import Maplist from "../components/Maplist";

export default {
  components: {
    Nav,
    Cooperate,
    Informations,
    Files,
    Maplist,
  },
};
</script>

<style lang="scss" scoped>
.home {
  .sticky {
    position: fixed;
    top: 0;
    width: 100%;
    background-color: white;
    z-index: 1;
  }
  .maplist {
    margin-top: 64px;
    max-width: 100vw;
    max-height: 80vh;
    @media (orientation: portrait) {
      max-height: unset;
    }
  }

  .info {
    max-width: 80%;
    margin: 0px auto 50px auto;
  }

  .files {
    max-width: 700px;
    margin: 50px auto 100px auto;
    padding: 0 5%;
    @media (min-width: 2500px) {
      max-width: 1400px;
    }
  }
}
</style>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");

input,
textarea,
button,
select,
a,
p,
i,
img {
  -webkit-tap-highlight-color: transparent;
}

.noselect {
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
</style>
