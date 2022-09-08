import maplibregl from "maplibre-gl";
import LocationIcon from "@/assets/icons/locationIcon.svg";

function popupHTML(marker) {
  return "<b>" + marker.name + "</b>,<br>" + marker.location.name;
}

export function createMarker(marker, map) {
  const popup = new maplibregl.Popup({ offset: 25 }).setHTML(popupHTML(marker));

  let markerElement = document.createElement("img");
  markerElement.className = "marker";
  markerElement.src = LocationIcon;
  markerElement.style.height = "20px";
  markerElement.style.width = "20px";

  let mapMarker = new maplibregl.Marker(markerElement)
      .setLngLat(marker.location.coordinates)
      .setPopup(popup)
      .addTo(map);

  markerElement.addEventListener("mouseenter", function () {
    mapMarker.togglePopup();
  });
  markerElement.addEventListener("mouseleave", function () {
    mapMarker.togglePopup();
  });

  return mapMarker;
}
