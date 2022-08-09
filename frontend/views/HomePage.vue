<template>
  <div class="home">
    <NavigationBar class="sticky" />
    <MapList class="maplist" />
  </div>
</template>

<script>
import NavigationBar from "@/components/NavigationBar.vue";
import MapList from "@/components/MapList.vue";

export default {
  components: {
    NavigationBar,
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
    top: 0;
    width: 100%;
    z-index: 2;
  }
  .maplist {
    position: fixed;
    max-width: 100vw;
    max-height: 100%;
    @media (orientation: portrait) {
      max-height: 65%;
    }
  }
}

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
