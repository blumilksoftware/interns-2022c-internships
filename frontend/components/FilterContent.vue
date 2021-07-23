<template>
  <div class="wrapper">
    <div class="drpDwnBtnSect">
      <div class="headfields">
        <CourseSelector class="headfield" />
        <CitySelector class="headfield" />
        <PaidSelector class="headfield paidSelector" />
      </div>
      <hr />
      <p class="tagTitleText noselect">
        # Wybierz najważniejszą technologię z tagów
      </p>
      <div class="tagsContainer noselect">
        <div class="tag"><span>React</span></div>
        <div class="tag"><span>JS</span></div>
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
      <button v-on:click="dropdown" class="approveFilters">
        Zatwierdź filtry
      </button>
    </div>
    <div v-on:click="dropdown" class="drpDwnBtn noselect">
      <p class="drpDwmBtnText">Filtrowanie</p>
    </div>
  </div>
</template>
<script>
import PaidSelector from "./PaidSelector.vue";
import CitySelector from "./CityFieldSelector.vue";
import CourseSelector from "./CourseFieldSelector";

export default {
  components: {
    PaidSelector: PaidSelector,
    CitySelector: CitySelector,
    CourseSelector: CourseSelector,
  },
  data() {
    return {
      isActive: false,
    };
  },

  methods: {
    dropdown() {
      document
        .querySelector(".drpDwnBtnSect")
        .classList.toggle("drpDwnBtnSectActive");
    },
  },
  mounted: function () {
    const tags = document.querySelectorAll(".tag");
    const arr = [];

    for (let i = 0; i < tags.length; i++) {
      tags[i].addEventListener("click", function () {
        if (arr.includes(tags[i].firstElementChild.innerText)) {
          const index = arr.indexOf(tags[i].firstElementChild.innerText);
          if (index > -1) {
            arr.splice(index, 1);
          }
        } else {
          arr.push(tags[i].firstElementChild.innerText);
        }
        tags[i].classList.toggle("highlight");
        // console.log(arr);
      });
    }
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
  /* -webkit-transition: all 1s 0s ease;
  -moz-transition: all 1s 0s ease;
  -o-transition: all 1s 0s ease;
  transition: all 1s 0s ease; */
  display: none;
  flex-direction: column;
}

.drpDwnBtnSectActive {
  height: auto;
  opacity: 1;
  display: flex;
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
.drpDwnBtn:active {
  border: 1px solid #4f46e5;
  background-color: #6761da;
  /* transition: 1s ease; */
}

.field {
  border: 2px solid #dbdbdb;
  background: white;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: #5e5e5e;
  cursor: pointer;
  position: relative;
  z-index: 2;
}
.crsSlctr::before {
  content: "";
  position: absolute;
  width: 103.5%;
  height: 50px;
  top: 80%;
  opacity: 0;
  background: white;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
  border-bottom: 2px solid #dbdbdb;
  border-left: 2px solid #dbdbdb;
  border-right: 2px solid #dbdbdb;
  z-index: 1;
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
.headfields {
  width: 95%;
  display: flex;
  flex-direction: row;
  align-items: center;
  margin: 0 auto;
}
.headfield {
  width: 33%;
  margin: 15px 9px;
  border-radius: 5px;
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
  -webkit-touch-callout: none; /* iOS Safari */
  -webkit-user-select: none; /* Safari */
  -khtml-user-select: none; /* Konqueror HTML */
  -moz-user-select: none; /* Old versions of Firefox */
  -ms-user-select: none; /* Internet Explorer/Edge */
  user-select: none;
}
.approveFilters {
  /* background-color: #dbdbdb; */
  color: #494747;
  font-size: 14px;
  width: 28%;
  margin: 0 auto 30px auto;
  padding: 5px 10px;
  border: 1px solid #dbdbdb;
  border-radius: 10px;
}
.approveFilters:active {
  border-color: #4f46e5;
}
.highlight {
  border-color: #4f46e5;
  background: #f0efff;
}
@media (orientation: portrait) {
  .headfields {
    flex-direction: column;
  }
  .headfield {
    width: 100%;
  }
  .headfield select {
    width: 100%;
  }
  .paidSelector {
    width: 100%;
  }
  .approveFilters {
    font-size: 12px;
    width: 40%;
  }
  .drpDwnBtn {
    width: 95%;
    margin: 0 auto;

    /* border-radius: 0; */
  }
  .drpDwnBtnSect {
    width: 95%;
    margin: 0 auto;
  }
}
</style>
