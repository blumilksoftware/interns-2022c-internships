<template>
  <div>
    <div
      v-if="loading"
      class="
        flex
        justify-center
        items-center
        w-full
        h-full
        bg-gray-300
        text-gray-400
      "
    >
      <location-marker-icon
        class="h-36 w-36 animate-pulse"
        aria-hidden="true"
      />
    </div>
    <div id="map" class="w-full h-full"></div>
    <searchBar v-if="isPortrait()" class="searchBarMobile" />
  </div>
</template>

<script>
import mapboxgl from "mapbox-gl";
import controls from "./mixins/controls";

import Search from "./searchBar.vue";
import { LocationMarkerIcon } from "@heroicons/vue/outline";

export default {
  components: {
    LocationMarkerIcon,
    searchBar: Search,
  },
  mixins: [controls],
  mounted() {
    mapboxgl.accessToken =
      "pk.eyJ1IjoibHVrYXN6cG9kbGlwc2tpIiwiYSI6ImNrcjNiZzVwdTJqcXEyenFhcHMxYzVjN28ifQ.XWodc1OUd2t_VJoAM2QNpQ";
    this.buildMap();
  },
  data() {
    return {
      loading: false,
      map: null,
      filtered: [],
    };
  },

  methods: {
    isPortrait() {
      if (window.innerHeight > window.innerWidth) {
        return true;
      } else {
        return false;
      }
    },
    buildMap() {
      this.map = new mapboxgl.Map({
        container: "map",
        style: "mapbox://styles/lukaszpodlipski/ckr3bjz8s0vju18mppy99hag2",
      });
      this.addControls();
      // this.addSearch()
      // this.buildMarkers()
    },
  },
};
</script>

<style lang="scss" scoped>
.searchBarMobile {
  position: absolute;
  top: 75px;
  left: 0;
  right: 0;
  margin: 0 auto;
  width: 90vw;
}
.map-marker-popup > div:not(:first-child) {
  padding: 4px 8px;
}
#map-controls {
  i {
    margin: auto;
  }
}
</style>
