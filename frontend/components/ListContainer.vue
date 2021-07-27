<template>
  <div class="wrapper">
    <searchBar v-if="!isMobile()" class="searchBar" />
    <FilterContent class="filterBtn" />
    <div v-if="!isMobile()" class="datafields">
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
      <DataFieldDesc class="datafield" />
    </div>
    <div v-else class="datafields">
      <DataFieldMobile class="datafield" />
      <DataFieldMobile class="datafield" />
      <DataFieldMobile class="datafield" />
      <DataFieldMobile class="datafield" />
      <DataFieldMobile class="datafield" />
      <DataFieldMobile class="datafield" />
      <DataFieldMobile class="datafield" />
      <DataFieldMobile class="datafield" />
      <DataFieldMobile class="datafield" />
      <DataFieldMobile class="datafield" />
      <DataFieldMobile class="datafield" />
      <DataFieldMobile class="datafield" />
      <DataFieldMobile class="datafield" />
    </div>
    <Buttons class="buttons" />
  </div>
</template>

<script>
import Buttons from "./Buttons.vue";
import DataFieldDesc from "./DataFldDesc.vue";
import DataFieldMobile from "./DataFldMobile.vue";
import SearchBar from "./searchBar.vue";
import FilterContent from "./FilterContent.vue";

export default {
  components: {
    Buttons,
    DataFieldDesc,
    DataFieldMobile,
    SearchBar,
    FilterContent,
  },
  data() {
    return {};
  },
  methods: {
    isMobile() {
      if (window.innerHeight > window.innerWidth) {
        return true;
      } else {
        return false;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  height: 70vh;
  @media (orientation: portrait) {
    width: 100vw;
    height: auto;
  }
  .searchBar {
    width: 90%;
    margin: 20px auto 10px auto;
  }

  .filterBtn {
    height: auto;
    width: 90%;
    margin: 0 auto 20px auto;

    @media (orientation: portrait) {
      margin-top: 25px;
    }
  }

  .datafields {
    height: 93%;
    overflow: scroll;
    overflow-x: hidden;
    justify-items: flex-start;
    min-width: 500px;
    @media (orientation: portrait) {
      max-height: 65vh;
      min-width: unset;
    }
    .datafield {
      width: 94%;
      background: #eaedf0;
      // margin: 12px 5px;
      border-radius: 5px;
      -webkit-box-shadow: 3px 4px 3px 0px rgba(0, 0, 0, 0.1);
      -moz-box-shadow: 3px 4px 3px 0px rgba(0, 0, 0, 0.1);
      box-shadow: 3px 4px 3px 0px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      margin: 12px auto;
    }
    .datafield:nth-child(odd) {
      background: #f7f7f8;
    }
  }
  .buttons {
    height: 50px;
    width: 100%;
  }
}
</style>
