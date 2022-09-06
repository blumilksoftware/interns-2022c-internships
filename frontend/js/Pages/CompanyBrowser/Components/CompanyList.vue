<script setup>
import CompanyTile from "./CompanyTile.vue";
import Pagination from "@/js/Shared/Components/PaginationList.vue";

defineProps({
  companies: Object,
});

const emit = defineEmits(["selectedCompany"]);
function onCompanySelect(value) {
  emit("selectedCompany", value);
}
</script>

<template>
  <div>
    <div
      class="shadow ring-1 ring-black ring-opacity-5 md:rounded-lg overflow-x-hidden overflow-y-scroll"
    >
      <template v-if="companies.data.length > 0">
        <div class="mb-1" v-for="company in companies.data" :key="company.id">
          <CompanyTile :company="company" @selectedCompany="onCompanySelect" />
        </div>
      </template>
      <div class="py-2 px-2 mt-1" v-else>
        <p>{{ $t("company_browser.no_companies_found") }}</p>
      </div>
    </div>
    <Pagination class="mt-6 mb-0 sticky" :links="companies.meta.links" />
  </div>
</template>
