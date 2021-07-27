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
.btncontainer {
  display: flex;
  flex-direction: row;
  align-items: stretch;

  .resetfilters {
    background: #4f46e5;
    &:active {
      background-color: #6761da;
    }
  }

  .saveasfile {
    background: #8da0d3;
    &:active {
      background: #94a2ce;
    }
  }
  .resetfilters,
  .saveasfile {
    height: 50px;
    width: 100%;
    display: block;
    font-size: 16px;
    color: white;

    & > * {
      color: white;
    }
    & > i {
      padding-right: 15px;
    }
  }
}
</style>
