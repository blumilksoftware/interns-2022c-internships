<template>
  <div class="home">
    <NavigationBar class="sticky" />
    <MapList class="maplist" />
    <InformationBar class="info" />
    <FileDownloadBar class="files" />
    <CooperateBar class="cooperate" />
  </div>
</template>

<script>
import NavigationBar from "@/components/NavigationBar.vue";
import CooperateBar from "@/components/CooperateBar.vue";
import InformationBar from "@/components/InformationBar.vue";
import FileDownloadBar from "@/components/FileDownloadBar.vue";
import MapList from "@/components/MapList.vue";

export default {
  components: {
    NavigationBar,
    CooperateBar,
    InformationBar,
    FileDownloadBar,
    MapList,
  },
  mounted() {
    window.scrollTo(0, 0);
  },
};
</script>

<style lang="pcss" scoped>
.home {
  .sticky {
    position: fixed;
    top: 0;
    width: 100%;
    background-color: var(--white);
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
