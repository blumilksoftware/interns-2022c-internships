<template>
  <div class="wrapper">
    <div
      class="drpDwnBtnSect"
      :class="{ drpDwnBtnSectActive: isDropdownActive }"
    >
      <div class="headfields">
        <BaseFieldSelector
          class="selector headfield"
          :dataGiven="cityData"
          name="Miasto"
        ></BaseFieldSelector>

        <BaseFieldSelector
          class="selector headfield"
          :dataGiven="courseData"
          name="Kierunek"
        ></BaseFieldSelector>
        <PaidSelector class="headfield paidSelector" />
      </div>
      <hr />
      <p class="tagTitleText noselect">
        # Wybierz najważniejszą technologię z tagów
      </p>
      <div class="tagsContainer noselect">
        <div
          class="tag"
          v-for="tag in tags.tags"
          :key="tag.name"
          :class="{ highlight: activeTags.includes(tag.name) }"
          @click="
            activeTags.includes(tag.name)
              ? activeTags.splice(activeTags.indexOf(tag.name), 1)
              : activeTags.push(tag.name)
          "
        >
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
import PaidSelector from "@/components/PaidSelector";
import BaseFieldSelector from "@/components/BaseFieldSelector";
import tags from "../../resources/templates/testTags.json";

export default {
  components: {
    PaidSelector,
    BaseFieldSelector,
  },
  props: {
    reset: Boolean,
  },
  data() {
    return {
      isActive: false,
      isDropdownActive: false,
      tags,
      activeTags: [],
      cityData: [
        {
          name: "Wrocław",
        },
        {
          name: "Legnica",
        },
        {
          name: "Lubin",
        },
      ],
      courseData: [
        {
          name: "Informatyka",
        },
        {
          name: "Grafika",
        },
        {
          name: "Ekonomia",
        },
      ],

    };
  },

  methods: {
    dropdown() {
      this.isDropdownActive = !this.isDropdownActive;
    },
  },
  mounted: function () {
    this.eventBus.on("reset", function (reset) {
      if (reset) {
        let high = document.querySelectorAll(".highlight");
        for (var i = 0; i < high.length; i++) {
          high[i].classList.toggle("highlight");
        }
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
@import "../assets/styles/_variables";

.selector {
  border-color: $darkGreyColor;
  @media (orientation: portrait) {
    width: 100%;
  }
}
.wrapper {
  .drpDwnBtnSect {
    width: 100%;
    opacity: 0%;
    height: 0;
    transform: translateY(15px);
    border-radius: 5px;
    border: 2px solid $lightGreyColor;
    display: none;
    flex-direction: column;
    background-color: $white;

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
      border: 1px solid $lightGreyColor;
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
        color: $mediumDarkGreyColor;
        border: 1px solid $mediumDarkGreyColor;
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
        border-color: $mainBlue;
        background: #f0efff;
      }
    }
    .approveFilters {
      color: $black;
      font-size: 14px;
      width: 28%;
      margin: 0 auto 30px auto;
      padding: 5px 10px;
      border: 1px solid $mediumDarkGreyColor;
      border-radius: 10px;

      &:active {
        border-color: $mainBlue;
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
    background-color: $mainBlue;
    border-radius: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    cursor: pointer;

    &:active {
      border: 1px solid $mainBlue;
      background-color: $mainBlueActive;
    }
    @media (orientation: portrait) {
      width: 95%;
      margin: 0 auto;
    }

    .drpDwmBtnText {
      color: $white;
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
