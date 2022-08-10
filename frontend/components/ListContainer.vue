<template>
  <div class="wrapper flex-col justify-end h-screen flex-wrap">
    <SearchBar class="searchBar flex-col w-full my-auto" />
    <div
      class="datafields flex-initial h-i overflow-scroll overflow-x-hidden justify-items-start max-w-full"
    >
      <DataField
        class="datafield bg-gray-50 w-full rounded shadow cursor-pointer my-3 scrollbar-thumb:bg-zinc-500 scrollbar-track:rounded"
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
