import maplibregl from "maplibre-gl"
import LocationIcon from "@/assets/icons/locationIcon.svg"
import CollegeIcon from "@/assets/icons/college.svg"
import assets from "@/assets.json"

function setDefaultSize(markerHtmlElement) {
  markerHtmlElement.style.height = "20px"
  markerHtmlElement.style.width = "20px"
}

function addListeners(maplibreMarker, markerHtmlElement) {
  markerHtmlElement.addEventListener("mouseenter", function () {
    maplibreMarker.togglePopup()
  })
  markerHtmlElement.addEventListener("mouseleave", function () {
    maplibreMarker.togglePopup()
  })
}

function placeMarkerOnMap(map, position, popup, markerElement) {
  return new maplibregl.Marker(markerElement)
    .setLngLat(position)
    .setPopup(popup)
    .addTo(map)
}

export function createCollegeMarker(map, collegeMarkerInfo) {
  const popup = new maplibregl.Popup({ offset: 25 }).setText(collegeMarkerInfo)

  let markerHtmlElement = document.createElement("img")
  markerHtmlElement.className = "marker"
  markerHtmlElement.src = CollegeIcon

  setDefaultSize(markerHtmlElement)
  let createdMarker = placeMarkerOnMap(
    map,
    [assets.college.longitude, assets.college.latitude],
    popup,
    markerHtmlElement,
  )
  addListeners(createdMarker, markerHtmlElement)

  return createdMarker
}

export function createCompanyMarker(markerData, map) {
  const popup = new maplibregl.Popup({ offset: 25 }).setHTML(
    "<b>" + markerData.name + "</b>,<br>" + markerData.location.name,
  )

  let markerHtmlElement = document.createElement("img")
  markerHtmlElement.className = "marker"
  markerHtmlElement.src = LocationIcon

  setDefaultSize(markerHtmlElement)
  let createdMarker = placeMarkerOnMap(
    map,
    markerData.location.coordinates,
    popup,
    markerHtmlElement,
  )
  addListeners(createdMarker, markerHtmlElement)

  return createdMarker
}
