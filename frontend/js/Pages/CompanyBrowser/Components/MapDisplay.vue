<script setup>
import "mapbox-gl/dist/mapbox-gl.css";
import "v-mapbox/dist/v-mapbox.css";
import { VMap } from "v-mapbox";
import mapboxgl from "mapbox-gl";
import { createMarker } from "./CompanyMarker.js";
import { reactive, watch } from "vue";

const props = defineProps({
  markers: Array,
});

let loadedMap;
let loadedMarkers = [];

const state = reactive({
  map: {
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

defineExpose({
  goTo,
  toggleMarkers,
});

function goTo(markerId) {
  let marker = loadedMarkers.find((item) => item.id === markerId).loadedMarker;

  loadedMap.flyTo({
    center: marker.getLngLat(),
    zoom: 15,
  });
}

function toggleMarkers() {
  loadedMarkers.forEach(function (marker) {
    let htmlElement = marker.loadedMarker.getElement();
    htmlElement.style.opacity = "0.4";
    htmlElement.style.height = "14px";
    htmlElement.style.width = "14px";
  });

  props.markers.forEach(function (marker) {
    let match = loadedMarkers.find((item) => item.id === marker.id);

    if (match !== null) {
      let styledElement = match.loadedMarker.getElement();
      styledElement.style.opacity = "1";
      styledElement.style.height = "20px";
      styledElement.style.width = "20px";
    }
  });
}

watch(
  () => props.markers,
  () => {
    toggleMarkers();
  },
  { deep: true }
);

const emit = defineEmits(["selectedCompany"]);
function loadMarkers() {
  props.markers.forEach(function (marker) {
    let loadedMarker = createMarker(marker, loadedMap);
    loadedMarker.getElement().addEventListener("click", function () {
      emit("selectedCompany", marker.id);
    });
    let id = marker.id;
    loadedMarkers.push({ id, loadedMarker });
  });
}

function onMapLoaded(createdMap) {
  loadedMap = createdMap;
  loadedMap.addControl(new mapboxgl.NavigationControl());
  loadedMap.addControl(new mapboxgl.FullscreenControl());
  loadedMap.dragRotate.disable();
  loadedMap.touchZoomRotate.disableRotation();

  loadedMap.on("idle", function () {
    loadedMap.resize();
  });

  loadMarkers();
}
</script>

<template>
  <VMap class="h-full w-full" :options="state.map" @loaded="onMapLoaded">
  </VMap>
</template>
