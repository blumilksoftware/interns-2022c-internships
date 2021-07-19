<template>
  <div class="wrapper">
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
      <DataField class="datafield" />
      <DataField class="datafield" />
    </div>
    <Buttons class="buttons" />
  </div>
</template>

<script>
import Btns from "./Buttons.vue";
import DtFld from "./DataFld.vue";

export default {
  components: {
    Buttons: Btns,
    DataField: DtFld,
  },
};
</script>

<style>
.wrapper {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  height: 70vh;
}
.buttons {
  /* align-items: flex-start; */
  height: 7%;
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
</style>
