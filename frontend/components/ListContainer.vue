<template>
  <div class="wrapper">
    <searchBar v-if="!isMobile()" class="searchBar" />
    <FilterContent class="filterBtn" />
    <div class="datafields">
      <DataField
        class="datafield"
        v-for="company in companies"
        :key="company.id"
        :companyName="company.name"
        :course="company.filterData.specializationName"
        :location="company.address.cityName"
        :companyTags="company.filterData.tags"
      />
    </div>
    <ButtonGeneric class="buttons" />
  </div>
</template>

<script>
import ButtonGeneric from "@/components/ButtonGeneric.vue";
import DataField from "@/components/DataField.vue";
import SearchBar from "@/components/SearchBar.vue";
import FilterContent from "@/components/FilterContent.vue";
import { isMobile } from "../functions/functions.js";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  components: {
    ButtonGeneric,
    DataField,
    SearchBar,
    FilterContent,
  },
  setup() {
    const store = useStore();

    return {
      companies: computed(() => store.getters.getCompaniesMerged),
      isMobile,
    };
  },
};
</script>

<style lang="pcss" scoped>
.wrapper {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  height: 70vh;
  @media (orientation: portrait) {
    width: 100vw;
    height: auto;
  }
  .searchBar {
    width: 90%;
    margin: 20px auto 10px auto;
  }

  .filterBtn {
    height: auto;
    width: 90%;
    margin: 10px auto 20px auto;

    @media (orientation: portrait) {
      margin-top: 25px;
    }
  }

  .datafields {
    height: 93%;
    overflow: scroll;
    overflow-x: hidden;
    justify-items: flex-start;
    min-width: 500px;
    @media (orientation: portrait) {
      max-height: 65vh;
      min-width: unset;
    }
    .datafield {
      width: 94%;
      background: var(--white);
      border-radius: 5px;
      -webkit-box-shadow: 3px 4px 3px 0px rgba(0, 0, 0, 0.1);
      -moz-box-shadow: 3px 4px 3px 0px rgba(0, 0, 0, 0.1);
      box-shadow: 3px 4px 3px 0px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      margin: 12px auto;
    }

    &::-webkit-scrollbar {
      background-color: rgb(243, 246, 248);
      width: 12px;
    }

    &::-webkit-scrollbar-thumb {
      background-color: #babac0;
      border-radius: 16px;
      border: 3px solid rgb(243, 246, 248);
    }
    &::-webkit-scrollbar-thumb:hover {
      background-color: #a0a0a5;
      border: 2px solid #f4f4f4;
    }
  }
  .buttons {
    height: 50px;
    width: 100%;
  }
}
</style>
