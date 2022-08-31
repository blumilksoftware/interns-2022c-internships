<template>
  <VMap class="h-full w-full" :options="state.map" @loaded="onMapLoaded">
  </VMap>
</template>

<script setup>
import "mapbox-gl/dist/mapbox-gl.css";
import "v-mapbox/dist/v-mapbox.css";
import { VMap } from "v-mapbox";
import mapboxgl from "mapbox-gl";
import LocationIcon from "@/assets/icons/locationIcon.svg";

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

function popupHTML(marker) {
  return "<b>" + marker.label + "</b>,<br>" + marker.location;
}

function createMarker(marker, map) {
  const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(popupHTML(marker));

  let el = document.createElement("img");
  el.className = "marker";
  el.src = LocationIcon;
  el.style.height = "20px";
  el.style.width = "20px";

  el.addEventListener("click", function () {
    map.flyTo({
      center: marker.coordinates,
      zoom: 15,
    });
  });

  return new mapboxgl.Marker(el)
    .setLngLat(marker.coordinates)
    .setPopup(popup)
    .addTo(map);
}

function onMapLoaded(map) {
  map.addControl(new mapboxgl.NavigationControl());
  map.addControl(new mapboxgl.FullscreenControl());

  props.markers.forEach(function (marker) {
    createMarker(marker, map);
  });
}
</script>
