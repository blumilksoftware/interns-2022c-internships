<script setup>
import "maplibre-gl/dist/maplibre-gl.css";
import maplibregl from "maplibre-gl";
import { Map } from "maplibre-gl";
import { markRaw, onMounted, onUnmounted, ref } from "vue";
import "@maptiler/geocoder/css/geocoder.css";

import LocationIcon from "@/assets/icons/locationIcon.svg";

const mapContainer = ref();
let loadedMap;
let locationMarker;

function createMarker(center) {
  let markerElement = document.createElement("img");
  markerElement.className = "marker";
  markerElement.src = LocationIcon;
  markerElement.style.height = "35px";
  markerElement.style.width = "35px";

  return new maplibregl.Marker(markerElement, { draggable: true }).setLngLat(
    center
  );
}

defineExpose({
  getCoordinates,
  onMapLoaded,
});

function getCoordinates() {
  return locationMarker.getLngLat();
}

function onMapLoaded(coords) {
  loadedMap.addControl(new maplibregl.NavigationControl());
  loadedMap.addControl(new maplibregl.FullscreenControl());
  loadedMap.addControl(new maplibregl.ScaleControl());
  loadedMap.addControl(new maplibregl.LogoControl());
  loadedMap.dragRotate.disable();
  loadedMap.touchZoomRotate.disableRotation();
  locationMarker = createMarker(coords).addTo(loadedMap);
  loadedMap.setCenter(coords);

  loadedMap.on("idle", function () {
    loadedMap.resize();
  });
}

onMounted(() => {
  loadedMap = markRaw(
    new Map({
      container: mapContainer.value,
      style: `https://api.maptiler.com/maps/streets/style.json?key=${
        import.meta.env.VITE_MAPLIBRE_TOKEN
      }`,
      zoom: 5,
      maxZoom: 20,
      crossSourceCollisions: false,
      failIfMajorPerformanceCaveat: false,
      attributionControl: false,
      preserveDrawingBuffer: true,
      hash: false,
      minPitch: 0,
      maxPitch: 60,
    })
  );

  loadedMap.on("load", function () {
    onMapLoaded();
  });
});

onUnmounted(() => {
  loadedMap.remove();
});
</script>

<template>
  <div class="map h-full w-full" ref="mapContainer"></div>
</template>
