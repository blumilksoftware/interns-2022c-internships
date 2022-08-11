<template>
  <div id="map" class="map w-full h-full overflow-hidden"></div>
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
