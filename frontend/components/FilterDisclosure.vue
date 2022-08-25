<template>
  <div class="w-full px-4 py-1">
    <div class="w-full rounded-2xl">
      <Disclosure v-slot="{ open }">
        <DisclosureButton
          class="flex w-full justify-center rounded-lg bg-slate-100 px-4 py-2 text-left text-sm font-medium text-slate-900 hover:bg-slate-200 focus:outline-none focus-visible:ring focus-visible:ring-slate-500 focus-visible:ring-opacity-75"
        >
          <span> {{ $t("CompanyBrowser.filter") }} </span>
          <ChevronDownIcon
            :class="open ? 'rotate-180 transform' : ''"
            class="h-5 w-5 text-slate-500"
          />
        </DisclosureButton>
        <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-slate-500">
          <FilterCombobox
            :placeholder="$t('Comboboxes.combobox-city')"
            :items="cities"
            :id="'cities-${index}'"
          />
          <div class="flex gap-x-2 mt-1">
            <FilterCombobox
              :placeholder="$t('Comboboxes.combobox-department')"
              :items="studyfields"
              :id="'studyfields-${index}'"
            />
            <FilterCombobox
              :placeholder="$t('Comboboxes.combobox-field')"
              :items="depreparments"
              :id="'studyfields-${index}'"
            />
            <FilterCombobox
              :placeholder="$t('Comboboxes.combobox-specialization')"
              :items="specialization"
              :id="'specialization-${index}'"
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
import FilterCombobox from "@/components/ComboBox.vue";

const cities = ["City", "Other city"];
const specialization = ["A specialization", "Other specialization"];
const studyfields = ["Some studyfields", "Other studyfields"];
const departments = ["Some department", "Other department"];
</script>
