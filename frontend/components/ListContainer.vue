<template>
  <div class="wrapper">
    <searchBar v-if="!isMobile()" class="searchBar" />
    <FilterContent class="filterBtn" />
    <div v-if="!isMobile()" class="datafields">
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
      <DataFieldDT class="datafield" />
    </div>
    <div v-else class="datafields">
      <DataFieldMB class="datafield" />
      <DataFieldMB class="datafield" />
      <DataFieldMB class="datafield" />
      <DataFieldMB class="datafield" />
      <DataFieldMB class="datafield" />
      <DataFieldMB class="datafield" />
      <DataFieldMB class="datafield" />
      <DataFieldMB class="datafield" />
      <DataFieldMB class="datafield" />
      <DataFieldMB class="datafield" />
      <DataFieldMB class="datafield" />
      <DataFieldMB class="datafield" />
      <DataFieldMB class="datafield" />
    </div>
    <Buttons class="buttons" />
  </div>
</template>

<script>
import Btns from "./Buttons.vue";
import DtFldDT from "./DataFldDesc.vue";
import DtFldMB from "./DataFldMobile.vue";
import Search from "./searchBar.vue";
import FilterContent from "./FilterContent.vue";

export default {
  components: {
    Buttons: Btns,
    DataFieldDT: DtFldDT,
    DataFieldMB: DtFldMB,
    searchBar: Search,
    FilterContent: FilterContent,
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

<style scoped>
.wrapper {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  height: 70vh;
}
.buttons {
  /* align-items: flex-start; */
  height: 50px;
  width: 100%;
}
.datafields {
  height: 93%;
  overflow: scroll;
  overflow-x: hidden;
  justify-items: flex-start;
}

.datafield {
  width: 98%;
  background: #eaedf0;
  margin: 8px 5px;
  border-radius: 5px;
  -webkit-box-shadow: 3px 4px 3px 0px rgba(0, 0, 0, 0.1);
  -moz-box-shadow: 3px 4px 3px 0px rgba(0, 0, 0, 0.1);
  box-shadow: 3px 4px 3px 0px rgba(0, 0, 0, 0.1);
}
.datafield:nth-child(odd) {
  background: #f7f7f8;
}

.searchBar {
  width: 90%;
  margin: 20px auto 10px auto;
}

.filterBtn {
  height: auto;
  width: 90%;
  margin: 0 auto 20px auto;
}
@media (orientation: portrait) {
  .wrapper {
    width: 100vw;
    height: auto;
  }
  .filterBtn {
    margin-top: 15px;
  }
  .datafields {
    max-height: 65vh;
  }
}
</style>
