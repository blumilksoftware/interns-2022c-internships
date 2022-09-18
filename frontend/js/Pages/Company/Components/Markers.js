import maplibregl from "maplibre-gl";
import LocationIcon from "@/assets/icons/locationIcon.svg";
import CollegeIcon from "@/assets/icons/college.svg";

function setDefaultSize(markerHtmlElement) {
  markerHtmlElement.style.height = "20px";
  markerHtmlElement.style.width = "20px";
}

function addListeners(maplibreMarker, markerHtmlElement) {
  markerHtmlElement.addEventListener("mouseenter", function () {
    maplibreMarker.togglePopup();
  });
  markerHtmlElement.addEventListener("mouseleave", function () {
    maplibreMarker.togglePopup();
  });
}

function placeMarkerOnMap(map, position, popup, markerElement) {
  return new maplibregl.Marker(markerElement)
    .setLngLat(position)
    .setPopup(popup)
    .addTo(map);
}

export function createCollegeMarker(map) {
  const popup = new maplibregl.Popup({ offset: 25 }).setText("Nasza uczelnia.");

  let markerHtmlElement = document.createElement("img");
  markerHtmlElement.className = "marker";
  markerHtmlElement.src = CollegeIcon;

  setDefaultSize(markerHtmlElement);
  let createdMarker = placeMarkerOnMap(
    map,
    [16.1472681, 51.2048546],
    popup,
    markerHtmlElement
  );
  addListeners(createdMarker, markerHtmlElement);

  return createdMarker;
}

export function createCompanyMarker(markerData, map) {
  const popup = new maplibregl.Popup({ offset: 25 }).setHTML(
    "<b>" + markerData.name + "</b>,<br>" + markerData.location.name
  );

  let markerHtmlElement = document.createElement("img");
  markerHtmlElement.className = "marker";
  markerHtmlElement.src = LocationIcon;

  setDefaultSize(markerHtmlElement);
  let createdMarker = placeMarkerOnMap(
    map,
    markerData.location.coordinates,
    popup,
    markerHtmlElement
  );
  addListeners(createdMarker, markerHtmlElement);

  return createdMarker;
}
