<script setup>
import MapDisplay from "./Components/MapDisplay.vue";
import CompanyInfoBox from "./Components/CompanyInfoBox.vue";
import CompanyList from "./Components/CompanyList.vue";
import CompanyListHeader from "./Components/CompanyListHeader.vue";
import Filter from "./Components/FilterDisclosure.vue";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  filters: Object,
  companies: Object,
  cities: Object,
  departments: Object,
  markers: Object,
  selectedCompany: Object,
});

const showDetail = ref(false);
const mapComponent = ref();

function onCompanySelect(value) {
  Inertia.get(
    "/company/view/" + value.toString(),
    {},
    {
      preserveState: true,
      replace: true,
      only: ["selectedCompany"],
    }
  );

  mapComponent.value.goTo(value);
}
function onDestroy() {
    if (confirm("Are you sure you want to Delete")) {
      showDetail.value = false;
        Inertia.delete("/company/view/"+ props.selectedCompany.data.id);
    }
}
function onUpdate() {
    if (confirm("Are you sure you want to Update")) {
      showDetail.value = false;
        Inertia.replace("/company/view/"+ props.selectedCompany.data.id);
    }
}

function onDetailClose() {
  showDetail.value = false;
  Inertia.get(
      route("index"),
    {},
    {
      preserveState: true,
      replace: true,
      only: ["selectedCompany"],
    }
  );
}

watch(
  () => props.selectedCompany,
  () => {
    if (props.selectedCompany) {
      showDetail.value = true;
    }
  },
  { deep: true }
);

function onFiltersSelected(searchSelect, citySelect, specializationSelect) {
  Inertia.get(
    route(route().current()),
    {
      searchbox: searchSelect.value,
      city: citySelect.value,
      specialization: specializationSelect.value,
    },
    {
      preserveState: true,
      replace: true,
      only: ["markers", "companies"],
    }
  );
}
</script>

<template>
  <div
    class="flex-col w-full mx-0 flex sm:flex-row-reverse h-full overflow-hidden"
  >
    <div class="flex bg-gray-200 w-full h-full max-h-full">
      <!-- <MapDisplay
        :markers="markers.data"
        @selectedCompany="onCompanySelect"
        ref="mapComponent"
      /> -->
    </div>
    <div
      class="flex flex-col bg-gray-50 w-full h-1/2 md:w-3/5 lg:w-3/5 xl:w-2/5 sm:h-full"
    >
      <template v-if="!showDetail">
        <CompanyListHeader :total="companies.meta.total" />
        <Filter
          :departments="departments.data"
          :cities="cities.data"
          :filters="filters"
          @selected="onFiltersSelected"
        />
        <CompanyList
          class="h-full"
          :companies="companies"
          @selectedCompany="onCompanySelect"
        />
      </template>
      <template v-else>
        <CompanyInfoBox
          @destroy="onDestroy"
          @update="onUpdate"
          @close="onDetailClose"
          :company="selectedCompany.data"
          class="h-full"
        />
      </template>
    </div>
  </div>
</template>
