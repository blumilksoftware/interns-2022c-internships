<template>
  <div
    v-if="loading"
    class="flex justify-center items-center w-full h-full bg-gray-300 text-gray-400"
  >
    <location-marker-icon class="h-36 w-36 animate-pulse" aria-hidden="true" />
  </div>
  <div id="map" class="relative w-full h-full overflow-hidden"></div>
</template>

<script>
import mapboxgl from "mapbox-gl";
import "mapbox-gl/dist/mapbox-gl.css";

import { LocationMarkerIcon } from "@heroicons/vue/outline";

export default {
  components: {
    LocationMarkerIcon,
  },
  mounted() {
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
    buildMap() {
      this.map = new mapboxgl.Map({
        accessToken: import.meta.env.VITE_MAPBOX_TOKEN,
        minzoom: 5,
        type: "symbol",
        container: "map",
        style: "mapbox://styles/mapbox/light-v10?optimize=true",
      });

      this.map.addControl(new mapboxgl.NavigationControl());
    },
  },
};
</script>
