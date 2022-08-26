<template>
  <div class="w-full px-4 py-1">
    <div class="w-full rounded-2xl">
      <Disclosure v-slot="{ open }">
        <DisclosureButton
          class="flex w-full justify-center rounded-lg bg-slate-100 px-4 py-2 text-left text-sm font-medium text-slate-900 hover:bg-slate-200 focus:outline-none focus-visible:ring focus-visible:ring-slate-500 focus-visible:ring-opacity-75"
        >
          <span> {{ $t("CompanyBrowser.Filter") }} </span>
          <ChevronDownIcon
            :class="open ? 'rotate-180 transform' : ''"
            class="h-5 w-5 text-slate-500"
          />
        </DisclosureButton>
        <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-slate-500">
          <FilterCombobox
            :placeholder="$t('Comboboxes.ComboboxCity')"
            :items="cities"
          />
          <div class="flex gap-x-2 mt-1">
            <FilterCombobox
                :placeholder="$t('Comboboxes.ComboboxDepartment')"
                :items="departmentNames"
            />
            <FilterCombobox
              :placeholder="$t('Comboboxes.ComboboxField')"
              :items="studyFields"
            />
            <FilterCombobox
              :placeholder="$t('Comboboxes.ComboboxSpecialization')"
              :items="specializations"
            />
          </div>
        </DisclosurePanel>
      </Disclosure>
    </div>
  </div>
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/solid";
import FilterCombobox from "@/js/Shared/Components/ComboBox.vue";
import { computed } from "vue";

const cities = ["City", "Other city"];
const specialization = ["A specialization", "Other specialization"];

const props = defineProps({
  departments: Object,
});

const departmentNames = computed({
  get() {
    return props.departments.map(item => item.name)
  },
});

const studyFields = computed({
  get() {
    let fieldsPerDepartment = props.departments.map(field => field.studyFields);
    return [].concat.apply([], fieldsPerDepartment)
        .map(item => item.name);
  },
});

const specializations = computed({
  get() {
    let fieldsPerDepartment = props.departments.map(item => item.studyFields);
    let fields = [].concat.apply([], fieldsPerDepartment);
    let specializationsPerField = fields.map(item => item.specializations);
    return [].concat.apply([], specializationsPerField)
        .map(item => item.name);
  },
});
</script>
