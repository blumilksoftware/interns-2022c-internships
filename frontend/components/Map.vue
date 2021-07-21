<template>
  <MglMap
    :accessToken="accessToken"
    :mapStyle="mapStyle"
    :center="[0, 0]"
    :zoom="1"
  />
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
        "pk.eyJ1IjoibHVrYXN6cG9kbGlwc2tpIiwiYSI6ImNrcjNiZzVwdTJqcXEyenFhcHMxYzVjN28ifQ.XWodc1OUd2t_VJoAM2QNpQ",
      mapStyle: "mapbox://styles/lukaszpodlipski/ckr3bjz8s0vju18mppy99hag2",
    };
  },

  created() {
    this.mapbox = Mapbox;
  },
  methods: {},
};
</script>
