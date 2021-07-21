<template>
  <div class="wrapper">
    <searchBar class="searchBar" />
    <FilterContent class="filterBtn" />
    <div class="datafields">
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
      <DataField class="datafield" />
    </div>
    <Buttons class="buttons" />
  </div>
</template>

<script>
import Btns from "./Buttons.vue";
import DtFld from "./DataFld.vue";
import Search from "./searchBar.vue";
import FilterContent from "./FilterContent.vue";

export default {
  components: {
    Buttons: Btns,
    DataField: DtFld,
    searchBar: Search,
    FilterContent: FilterContent,
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
  width: 100%;
  background: #eaedf0;
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
</style>
