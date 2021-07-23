<template>
  <div class="wrapper">
    <div class="buttons noselect">
      <button v-on:click="btn1Click" class="default btn1 activeBtnNo noselect">
        BEZPŁATNE</button
      ><button v-on:click="btn2Click" class="default btn2 noselect">
        PŁATNE
      </button>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    btn1Click(e) {
      e.preventDefault();
      document.querySelector(".btn1").classList.add("activeBtnNo");
      document.querySelector(".buttons").classList.add("bgColorRed");
      document.querySelector(".btn2").classList.remove("activeBtnYes");
    },

    btn2Click(e) {
      e.preventDefault();

      document.querySelector(".btn2").classList.add("activeBtnYes");
      document.querySelector(".buttons").classList.remove("bgColorRed");
      document.querySelector(".buttons").classList.add("bgColorGreen");
      document.querySelector(".btn1").classList.remove("activeBtnNo");
    },
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  display: flex;
  flex-direction: row;

  .buttons {
    border: none;
    width: 100%;
    box-sizing: content-box;
    border-radius: 10px;
    background: #4f46e5;
    height: 42px;
    display: flex;
    align-items: center;

    .default {
      width: 50%;
      height: 30px;
      background: none;
      border-radius: 6px;
      font-size: 9px;
      color: white;
      transition: 0.1s ease-in;
    }

    .btn1 {
      border: none;
      height: 30px;
      margin-left: 5px;
    }
    .btn2 {
      border: none;
      height: 30px;
      margin-right: 5px;
    }
    .activeBtnNo {
      background: white;
      color: #4f46e5;
    }

    .activeBtnYes {
      background: white;
      color: #abe19e;
    }
  }

  .bgColorGreen {
    background: #abe19e;
  }
  .bgColorRed {
    background: #4f46e5;
  }
}
</style>
