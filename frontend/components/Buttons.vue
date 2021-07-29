<template>
  <div class="btncontainer">
    <button class="resetfilters" @click="resetButtons">
      <i class="far fa-eye"></i>
      Zresetuj filtry
    </button>
    <button class="saveasfile" href="www.the100clth.pl">
      <i class="fas fa-cloud-download-alt"></i>
      Zapisz do pliku
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      reset: true,
    };
  },
  methods: {
    resetButtons() {
      this.eventBus.emit("reset", this.reset);
    },
  },
};
</script>
<style lang="scss" scoped>
@import "../assets/styles/_variables";

.btncontainer {
  display: flex;
  flex-direction: row;
  align-items: stretch;

  .resetfilters {
    background: $mainBlue;
    &:active {
      background-color: $mainBlueActive;
    }
  }

  .saveasfile {
    background: $softBlue;
    &:active {
      background: $softBlueActive;
    }
  }
  .resetfilters,
  .saveasfile {
    height: 50px;
    width: 100%;
    display: block;
    font-size: 16px;
    color: $white;

    & > * {
      color: $white;
    }
    & > i {
      padding-right: 15px;
    }
  }
}
</style>
