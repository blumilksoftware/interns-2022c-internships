<template>
  <div class="wrapper">
    <div
      class="buttons noselect"
      :class="[{ bgColorIndigo: !paidActive }, { bgColorGreen: paidActive }]"
    >
      <button
        v-on:click="buttonUnpaid"
        class="defaultClass btnUnpaid noselect"
        :class="{ activeBtnNo: !paidActive }"
      >
        BEZPŁATNE</button
      ><button
        v-on:click="buttonPaid"
        class="defaultClass btnPaid noselect"
        :class="{ activeBtnYes: paidActive }"
      >
        PŁATNE
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      paidActive: false,
    };
  },

  methods: {
    buttonUnpaid(e) {
      e.preventDefault();
      this.paidActive = false;
    },

    buttonPaid(e) {
      e.preventDefault();
      this.paidActive = true;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../assets/styles/_variables";

.wrapper {
  display: flex;
  flex-direction: row;

  .buttons {
    border: none;
    width: 100%;
    box-sizing: content-box;
    border-radius: 10px;
    background: $mainBlue;
    height: 42px;
    display: flex;
    align-items: center;

    .defaultClass {
      width: 50%;
      height: 30px;
      background: none;
      border-radius: 6px;
      font-size: 9px;
      color: $white;
      transition: 0.1s ease-in;
    }

    .btnUnpaid {
      border: none;
      height: 30px;
      margin-left: 5px;
    }
    .btnPaid {
      border: none;
      height: 30px;
      margin-right: 5px;
    }
    .activeBtnNo {
      background: $white;
      color: $mainBlue;
    }

    .activeBtnYes {
      background: $white;
      color: $softGreen;
    }
  }

  .bgColorGreen {
    background: $softGreen;
  }
  .bgColorIndigo {
    background: $mainBlue;
  }
}
</style>
