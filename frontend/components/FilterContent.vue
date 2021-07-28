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
        <div class="tag" v-for="tag in tags.tags" :key="tag.name">
          <span>{{ tag.name }} </span>
        </div>
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
import tags from "../../resources/templates/testTags.json";

export default {
  components: {
    PaidSelector,
    CitySelector,
    CourseSelector,
  },
  props: {
    reset: Boolean,
  },
  data() {
    return {
      isActive: false,
      tags,
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
      });
    }
    this.eventBus.on("reset", function (reset) {
      if (reset) {
        let high = document.querySelectorAll(".highlight");
        for (var i = 0; i < high.length; i++) {
          high[i].classList.toggle("highlight");
        }
        arr.length = 0;
      }
    });
  },
};
</script>

<style lang="scss" scoped>
* {
  margin: 0;
  box-sizing: border-box;
}

.wrapper {
  .drpDwnBtnSect {
    width: 100%;
    opacity: 0%;
    height: 0;
    transform: translateY(15px);
    border-radius: 5px;
    border: 2px solid #d4d4d4;
    display: none;
    flex-direction: column;

    .headfields {
      width: 95%;
      display: flex;
      flex-direction: row;
      align-items: center;
      margin: 0 auto;

      @media (orientation: portrait) {
        flex-direction: column;
      }

      .headfield {
        width: 33%;
        margin: 15px 9px;
        border-radius: 5px;

        @media (orientation: portrait) {
          width: 100%;
        }
        select {
          @media (orientation: portrait) {
            width: 100%;
          }
        }
      }
      .paidSelector {
        @media (orientation: portrait) {
          width: 100%;
        }
      }
    }
    .tagTitleText {
      font-size: 12px;
      display: block;
      width: 92%;
      margin: 5px auto;
    }
    hr {
      border: 1px solid #dbdbdb;
      width: 92%;
      margin: 5px auto;
    }

    .tagsContainer {
      display: flex;
      flex-wrap: wrap;
      width: 94%;
      margin: 0 auto;
      margin-bottom: 20px;

      .tag {
        font-size: 12px;
        color: #5e5e5e;
        border: 1px solid #dbdbdb;
        padding: 2px 5px;
        margin: 2px 5px;
        cursor: pointer;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      .highlight {
        border-color: #4f46e5;
        background: #f0efff;
      }
    }
    .approveFilters {
      color: #494747;
      font-size: 14px;
      width: 28%;
      margin: 0 auto 30px auto;
      padding: 5px 10px;
      border: 1px solid #dbdbdb;
      border-radius: 10px;

      &:active {
        border-color: #4f46e5;
      }
      @media (orientation: portrait) {
        font-size: 12px;
        width: 40%;
      }
    }
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

    &:active {
      border: 1px solid #4f46e5;
      background-color: #6761da;
    }
    @media (orientation: portrait) {
      width: 95%;
      margin: 0 auto;
    }

    .drpDwmBtnText {
      color: white;
      font-family: Poppins;
      text-align: center;

      @media (orientation: portrait) {
        width: 95%;
        margin: 0 auto;
      }
    }
  }
}
</style>
