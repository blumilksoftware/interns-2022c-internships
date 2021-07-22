<template>
  <MglMap
    :accessToken="accessToken"
    :mapStyle="mapStyle"
    :center="[0, 0]"
    :zoom="1"
  />
  <searchBar v-if="isPortrait()" class="searchBarMobile" />
</template>

<script>
import Mapbox from "mapbox-gl";
import { MglMap } from "vue-mapbox";
import Search from "./searchBar.vue";

export default {
  components: {
    MglMap,
    searchBar: Search,
  },
  data() {
    return {
      accessToken:
        "pk.eyJ1IjoibHVrYXN6cG9kbGlwc2tpIiwiYSI6ImNrcjNiZzVwdTJqcXEyenFhcHMxYzVjN28ifQ.XWodc1OUd2t_VJoAM2QNpQ",
      mapStyle: "mapbox://styles/lukaszpodlipski/ckr3bjz8s0vju18mppy99hag2",
    };
  },

  created() {
    this.mapbox = Mapbox;
  },
  methods: {
    isPortrait() {
      if (window.innerHeight > window.innerWidth) {
        return true;
      } else {
        return false;
      }
    },
  },
};
</script>

<style scoped>
.searchBarMobile {
  position: absolute;
  top: 75px;
  left: 0;
  right: 0;
  margin: 0 auto;
  width: 90vw;
}
</style>
