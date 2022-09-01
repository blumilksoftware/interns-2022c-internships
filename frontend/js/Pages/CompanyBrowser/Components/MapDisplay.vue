<template>
  <VMap class="h-full w-full" :options="state.map" @loaded="onMapLoaded">
  </VMap>
</template>

<script setup>
import "mapbox-gl/dist/mapbox-gl.css";
import "v-mapbox/dist/v-mapbox.css";
import { VMap } from "v-mapbox";
import mapboxgl from "mapbox-gl";
import { createMarker } from "./CompanyMarker.js";
import { reactive } from "vue";

const props = defineProps({
  markers: Array,
});

const state = reactive({
  map: {
    container: "map",
    accessToken: import.meta.env.VITE_MAPBOX_TOKEN,
    style: "mapbox://styles/plencka/cl7hbllqc002d14nfp7pjt4pv?optimize=true",
    center: [16.1472681, 51.2048546],
    zoom: 5,
    maxZoom: 20,
    crossSourceCollisions: false,
    failIfMajorPerformanceCaveat: false,
    attributionControl: false,
    preserveDrawingBuffer: true,
    hash: false,
    minPitch: 0,
    maxPitch: 60,
  },
});

function loadMarkers(map) {
  props.markers.forEach(function (marker) {
    createMarker(marker, map);
  });
}

function onMapLoaded(map) {
  map.addControl(new mapboxgl.NavigationControl());
  map.addControl(new mapboxgl.FullscreenControl());
  map.dragRotate.disable();
  map.touchZoomRotate.disableRotation();

  map.on("idle", function () {
    map.resize();
  });

  loadMarkers(map);
}
</script>
