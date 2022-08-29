<template>
  <div class="w-full px-4 py-1">
    <div class="w-full rounded-2xl">
      <Disclosure v-slot="{ open }">
        <DisclosureButton
          class="flex w-full justify-center rounded-lg bg-slate-100 px-4 py-2 text-left text-sm font-medium text-slate-900 hover:bg-slate-200 focus:outline-none focus-visible:ring focus-visible:ring-slate-500 focus-visible:ring-opacity-75"
        >
          <span> {{ $t("CompanyBrowser.Search") }} </span>
          <ChevronDownIcon
            :class="open ? 'rotate-180 transform' : ''"
            class="h-5 w-5 text-slate-500"
          />
        </DisclosureButton>
        <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-slate-500">
          <div class="w-full">
            <label for="search" class="sr-only"
              >{{ $t("CompanyBrowser.Search") }}
            </label>
            <div class="relative">
              <div
                class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center"
              >
                <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
              </div>
              <input
                id="search"
                name="search"
                class="block w-full bg-white border border-gray-300 rounded-md py-2 pl-10 pr-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-1 focus:ring-slate-400 focus:border-slate-500 sm:text-sm"
                :placeholder="$t('CompanyBrowser.Search')"
                type="search"
              />
            </div>
          </div>
          <Treeselect
              :options="departments"
              :multiple="false"
              :show-count="true"
              :disable-branch-nodes="true"
              placeholder="Wybierz specjalizację..."
              v-model="value"
          />
          <Treeselect
            :options="departments"
            :multiple="false"
            :show-count="true"
            :disable-branch-nodes="true"
            placeholder="Wybierz specjalizację..."
            v-model="value"
          />
        </DisclosurePanel>
      </Disclosure>
    </div>
  </div>
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { ChevronDownIcon, SearchIcon } from "@heroicons/vue/solid";
import Treeselect from "vue3-treeselect";
import "vue3-treeselect/dist/vue3-treeselect.css";

const cities = ["City", "Other city"];

const props = defineProps({
  departments: Object,
});
</script>
