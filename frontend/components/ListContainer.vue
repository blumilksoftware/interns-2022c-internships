<template>
  <div class="wrapper">
    <searchBar class="searchBar" />
    <div class="datafields">
      <DataField
        class="datafield bg-gray-50"
        v-for="company in companies"
        :key="company.id"
        :companyName="company.name"
        :course="company.filterData.specializationName"
        :location="company.address.cityName"
        :companyTags="company.filterData.tags"
      />
    </div>
  </div>
</template>

<script>
import DataField from "@/components/DataField.vue";
import SearchBar from "@/components/SearchBar.vue";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  components: {
    DataField,
    SearchBar,
  },
  setup() {
    const store = useStore();

    return {
      companies: computed(() => store.getters.getCompaniesMerged),
    };
  },
};
</script>

<style lang="pcss" scoped>
.wrapper {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  height: 100vh;
  @media (orientation: portrait) {
    width: 100vw;
    height: 60vh;
  }
  .searchBar {
    position: flex;
    width: 90%;
    margin: auto auto auto auto;
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
