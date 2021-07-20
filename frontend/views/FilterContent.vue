<template>
  <div class="wrapper">
    <div class="drpDwnBtnSect">
      <div class="headfield">
        <div class="field courseSelector">
          <span class="noselect">Kierunek</span>
        </div>
        <div class="field citySelector">
          <span class="noselect">Miasto</span>
        </div>
        <PaidSelector class="" />
      </div>
      <hr />
      <p class="tagTitleText"># Wybierz najważniejszą technologię z tagów</p>
      <div class="tagsContainer">
        <div class="tag"><span>JS</span></div>
        <div class="tag"><span>React</span></div>
        <div class="tag"><span>Android</span></div>
        <div class="tag"><span>PHP</span></div>
        <div class="tag"><span>HTML/CSS</span></div>
        <div class="tag"><span>Data Analytics</span></div>
        <div class="tag"><span>C++</span></div>
        <div class="tag"><span>Python</span></div>
        <div class="tag"><span>Game Dev</span></div>
        <div class="tag"><span>Ruby</span></div>
        <div class="tag"><span>Java</span></div>
        <div class="tag"><span>.Net</span></div>
        <div class="tag"><span>Scala</span></div>
        <div class="tag"><span>Mobile</span></div>
        <div class="tag"><span>Testing</span></div>
        <div class="tag"><span>DevOps</span></div>
        <div class="tag"><span>Security</span></div>
        <div class="tag"><span>Scala</span></div>
      </div>
      <button class="approveFilters">Zatwierdź filtry</button>
    </div>
    <div v-on:click="dropdown" class="drpDwnBtn noselect">
      <p class="drpDwmBtnText">Filtrowanie</p>
    </div>
  </div>
</template>
<script>
import PaidSelector from "./PaidSelector.vue";

export default {
  components: {
    PaidSelector: PaidSelector,
  },

  methods: {
    dropdown() {
      document
        .querySelector(".drpDwnBtnSect")
        .classList.toggle("drpDwnBtnSectActive");
    },
  },
};
</script>

<style scoped>
* {
  margin: 0;
  box-sizing: border-box;
}
.drpDwnBtnSect {
  width: 100%;
  opacity: 0%;
  height: 0;
  transform: translateY(15px);
  border-radius: 5px;
  border: 2px solid #d4d4d4;
  display: flex;
  -webkit-transition: all 1s 0s ease;
  -moz-transition: all 1s 0s ease;
  -o-transition: all 1s 0s ease;
  transition: all 1s 0s ease;
  display: flex;
  flex-direction: column;
}

.drpDwnBtnSectActive {
  height: auto;
  opacity: 1;
}

.drpDwnBtn {
  width: 100%;
  height: 30px;
  background-color: #4f46e5;
  border-radius: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  cursor: pointer;
}

.drpDwmBtnText {
  color: white;
  font-family: Poppins;
}

.field {
  border: 2px solid #dbdbdb;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: #5e5e5e;
  cursor: pointer;
  position: relative;
}
/* .field::after {
  content: "";
  position: absolute;
  width: 100%;
  height: 50px;
  top: 3px;
  background: red;
} */
.noselect {
  -webkit-touch-callout: none; /* iOS Safari */
  -webkit-user-select: none; /* Safari */
  -khtml-user-select: none; /* Konqueror HTML */
  -moz-user-select: none; /* Old versions of Firefox */
  -ms-user-select: none; /* Internet Explorer/Edge */
  user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
}
.headfield {
  width: 95%;
  display: flex;
  flex-direction: row;
  align-self: flex-start;
  margin: 0 auto;
}
.headfield > * {
  width: 33%;
  margin: 15px 9px;
}
hr {
  border: 1px solid #dbdbdb;
  width: 92%;
  margin: 5px auto;
}
.tagTitleText {
  font-size: 12px;
  display: block;
  width: 92%;
  margin: 5px auto;
}
.tagsContainer {
  display: flex;
  flex-wrap: wrap;
  width: 94%;
  margin: 0 auto;
  margin-bottom: 20px;
}
.tag {
  font-size: 12px;
  color: #5e5e5e;
  border: 1px solid #dbdbdb;
  padding: 2px 5px;
  margin: 2px 5px;
  cursor: pointer;
}
.approveFilters {
  background-color: #dbdbdb;
  color: #494747;
  font-size: 14px;
  width: 28%;
  margin: 0 auto 30px auto;
  padding: 5px 10px;
  border-radius: 10px;
}
</style>
