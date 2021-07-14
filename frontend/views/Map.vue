<template>
  <MglMap :accessToken="accessToken" :mapStyle="mapStyle" />
</template>

<script>
import Mapbox from "mapbox-gl";
import { MglMap } from "vue-mapbox";

export default {
  components: {
    MglMap,
  },
  data() {
    return {
      accessToken:
        "pk.eyJ1IjoibHVrYXN6cG9kbGlwc2tpIiwiYSI6ImNrcjNiZzVwdTJqcXEyenFhcHMxYzVjN28ifQ.XWodc1OUd2t_VJoAM2QNpQ", // your access token. Needed if you using Mapbox maps
      mapStyle: "mapbox://styles/lukaszpodlipski/ckr3bjz8s0vju18mppy99hag2", // your map style
    };
  },

  created() {
    // We need to set mapbox-gl library here in order to use it in template
    this.mapbox = Mapbox;
  },
};
</script>
