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

import Search from "./searchBar.vue";
import { LocationMarkerIcon } from "@heroicons/vue/outline";

export default {
  components: {
    LocationMarkerIcon,
    searchBar: Search,
  },
  mounted() {
    mapboxgl.accessToken = process.env.VUE_APP_MAPBOX_TOKEN;
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
        style: process.env.VUE_APP_MAPBOX_STYLE_URL,
      });
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
