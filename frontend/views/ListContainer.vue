<template>
  <div class="wrapper">
    <div class="datafields">
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>
      <p>rararara</p>

      <!-- <DataField /> -->
    </div>
    <Buttons class="buttons" />
  </div>
</template>

<script>
import Btns from "./Buttons.vue";
// import DtFld from "./DataField.vue";

export default {
  components: {
    Buttons: Btns,
    // DataField: DtFld,
  },
};
</script>

<style>
.wrapper {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
}
.buttons {
  /* align-items: flex-start; */
  width: 100%;
}
.datafields {
  height: 100%;
  overflow: hidden;
  overflow-x: hidden;
  justify-items: flex-start;
}
</style>
