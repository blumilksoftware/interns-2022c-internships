<template>
  <div class="flex">
    <div class="Btns noselect">
      <button v-on:click="btn1Click" class="btn btn1 activeBtnNo noselect">
        BEZPŁATNE</button
      ><button v-on:click="btn2Click" class="btn btn2 noselect">PŁATNE</button>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    btn1Click(e) {
      e.preventDefault();
      document.querySelector(".btn1").classList.add("activeBtnNo");
      document.querySelector(".Btns").classList.add("bgColorRed");
      document.querySelector(".btn2").classList.remove("activeBtnYes");
    },

    btn2Click(e) {
      e.preventDefault();

      document.querySelector(".btn2").classList.add("activeBtnYes");
      document.querySelector(".Btns").classList.remove("bgColorRed");
      document.querySelector(".Btns").classList.add("bgColorGreen");
      document.querySelector(".btn1").classList.remove("activeBtnNo");
    },
  },
};
</script>

<style scoped>
.btn {
  width: 50%;
  height: 30px;
  background: none;
  border-radius: 6px;
  font-size: 9px;
  color: white;
  transition: 0.1s ease-in;
}
.btn1 {
  /* border:3px solid white; */
  border: none;
  height: 30px;
  margin-left: 5px;
}
.activeBtnNo {
  background: white;
  color: #4f46e5;
}
.btn2 {
  border: none;
  height: 30px;
  margin-right: 5px;
}
.flex {
  display: flex;
  flex-direction: row;
}
.activeBtnYes {
  background: white;
  color: #abe19e;
}
.Btns {
  border: none;
  width: 100%;
  box-sizing: content-box;
  border-radius: 10px;
  background: #4f46e5;
  height: 40px;
  display: flex;
  align-items: center;
}

.noselect {
  -webkit-touch-callout: none; /* iOS Safari */
  -webkit-user-select: none; /* Safari */
  -khtml-user-select: none; /* Konqueror HTML */
  -moz-user-select: none; /* Old versions of Firefox */
  -ms-user-select: none; /* Internet Explorer/Edge */
  user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
}

.bgColorGreen {
  background: #abe19e;
}
.bgColorRed {
  background: #4f46e5;
}
</style>
