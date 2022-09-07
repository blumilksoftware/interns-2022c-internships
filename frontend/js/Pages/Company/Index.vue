<script setup>
import MapDisplay from "./Components/MapDisplay.vue";
import CompanyInfoBox from "./Components/CompanyInfoBox.vue";
import CompanyList from "./Components/CompanyList.vue";
import CompanyListHeader from "./Components/CompanyListHeader.vue";
import Filter from "./Components/FilterDisclosure.vue";
import { ref, watch, onMounted } from "vue";
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
let map = ref();

function onCompanySelect(id) {
  Inertia.get(
    route("company-show", id),
    {},
    {
      preserveState: true,
      replace: true,
      only: ["selectedCompany"],
    }
  );
}

function onDestroy() {
  if (confirm("company_browser.confirm_delete")) {
    showDetail.value = false;
    Inertia.delete(route("company-delete", props.selectedCompany.data.id), {
      only: ["companies", "markers"],
      onSuccess: () => {
        map.value.resetMarkers();
      },
    });
  }
}

function onUpdate() {
  if (confirm("company_browser.confirm_verify")) {
    showDetail.value = false;
    Inertia.post(route("company-verify", props.selectedCompany.data.id), {
      only: ["companies, markers"],
      onSuccess: () => {
        map.value.resetMarkers();
      },
    });
  }
}

function onDetailClose() {
  showDetail.value = false;
  map.value.resetPosition();

  Inertia.get(
    route("company-close"),
    {},
    {
      preserveState: true,
      replace: true,
      only: ["selectedCompany"],
    }
  );
}

function onDetailZoom(id) {
  map.value.goTo(id);
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

function onMapLoad() {
  if (props.selectedCompany) {
    map.value.goTo(props.selectedCompany.data.id);
  }
}

onMounted(() => {
  if (props.selectedCompany) {
    showDetail.value = true;
  }
});
</script>

<template>
  <div
    class="flex-col w-full mx-0 flex sm:flex-row-reverse h-full overflow-hidden"
  >
    <div class="flex bg-gray-200 w-full h-full max-h-full">
      <MapDisplay
        :markers="markers.data"
        @selectedCompany="onCompanySelect"
        @loaded="onMapLoad"
        ref="map"
      />
    </div>
    <div
      class="flex flex-col shadow-lg bg-gray-50 w-full h-1/2 md:w-3/5 lg:w-3/5 xl:w-2/5 sm:h-full"
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
          @zoom="onDetailZoom"
          :company="selectedCompany.data"
          class="h-full"
        />
      </template>
    </div>
  </div>
</template>