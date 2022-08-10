<template>
  <div>
    <div v-if="loading" class="w-full h-full bg-gray-300 text-gray-400">
      <location-marker-icon
        class="h-36 w-36 animate-pulse"
        aria-hidden="true"
      />
    </div>
    <div id="map" class="w-full h-full"></div>
  </div>
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
    mapboxgl.accessToken = import.meta.env.VITE_MAPBOX_TOKEN;
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
        container: "map",
        style: import.meta.env.VITE_MAPBOX_STYLE_URL,
      });
      this.map.addControl(new mapboxgl.NavigationControl());
    },
  },
};
</script>
