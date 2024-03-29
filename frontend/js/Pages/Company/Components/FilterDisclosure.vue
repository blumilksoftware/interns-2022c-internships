<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue"
import { ChevronDownIcon, MagnifyingGlassIcon } from "@heroicons/vue/24/solid"
import { watch, ref, computed } from "vue"
import Treeselect from "@tkmam1x/vue3-treeselect"
import "@tkmam1x/vue3-treeselect/dist/vue3-treeselect.css"
import { usePage } from "@inertiajs/inertia-vue3"
import { useI18n } from "vue-i18n"

const i18n = useI18n()

const props = defineProps({
  filters: Object,
  departments: Array,
  cities: Array,
})

let searchSelect = ref(props.filters.searchSelect)
let citySelect = ref(props.filters.citySelect)
let specializationSelect = ref(props.filters.specializationSelect)
let ownedCompaniesSelect = ref(props.filters.ownedCompaniesSelect)
let companyStatusSelect = ref(props.filters.companyStatusSelect)

let ownedFilterValues = [
  {
    id: "owned",
    label: computed(() => i18n.t("company_browser.owned_only")),
  },
]

let companyStatusFilterValues = [
  {
    id: "verified",
    label: computed(() => i18n.t("company_browser.verified_only")),
  },
  {
    id: "pending_new",
    label: computed(() => i18n.t("company_browser.unverified_only")),
  },
]

const emit = defineEmits(["selected"])
function emitFilters() {
  emit("selected", searchSelect, citySelect, specializationSelect, ownedCompaniesSelect, companyStatusSelect)
}

watch([citySelect, specializationSelect, ownedCompaniesSelect, companyStatusSelect], () => {
  emitFilters()
})

watch(
  [searchSelect],
  _.debounce(() => {
    emitFilters()
  }, 500),
)
</script>

<template>
  <div class="w-full px-4 py-1">
    <div class="w-full rounded-2xl">
      <Disclosure v-slot="{ open }">
        <DisclosureButton
          class="flex w-full justify-center rounded-lg bg-slate-100 px-4 py-2 text-left text-sm font-medium text-slate-900 hover:bg-slate-200 focus:outline-none focus-visible:ring focus-visible:ring-slate-500 focus-visible:ring-opacity-75"
        >
          <span> {{ $t("company_browser.search") }} </span>
          <ChevronDownIcon
            :class="open ? 'rotate-180 transform' : ''"
            class="h-5 w-5 text-slate-500"
          />
        </DisclosureButton>
        <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-slate-500">
          <div class="w-full">
            <label
              for="search"
              class="sr-only"
            >{{ $t("company_browser.search") }}
            </label>
            <div class="relative">
              <div
                class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center"
              >
                <MagnifyingGlassIcon
                  class="h-5 w-5 text-gray-400"
                  aria-hidden="true"
                />
              </div>
              <input
                v-model="searchSelect"
                name="searchbox"
                class="block w-full bg-white border border-gray-300 rounded-md py-2 pl-10 pr-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-1 focus:ring-slate-400 focus:border-slate-500 sm:text-sm"
                :placeholder="$t('company_browser.search')"
                type="search"
              >
            </div>
          </div>
          <Treeselect
            v-model="citySelect"
            class="mt-2"
            :options="props.cities"
            :multiple="false"
            :show-count="true"
            :disable-branch-nodes="true"
            :placeholder="$t('tree_selects.city')"
          />
          <Treeselect
            v-model="specializationSelect"
            class="mt-2"
            :options="props.departments"
            :multiple="false"
            :disable-branch-nodes="true"
            :placeholder="$t('tree_selects.specialization')"
            search-nested
          />
          <Treeselect
            v-if="usePage().props.value.auth.user"
            v-model="ownedCompaniesSelect"
            class="mt-2"
            :options="ownedFilterValues"
            :multiple="false"
            :disable-branch-nodes="true"
            :placeholder="$t('tree_selects.ownedCompanies')"
          />
          <Treeselect
            v-if="usePage().props.value.auth.user"
            v-model="companyStatusSelect"
            class="mt-2"
            :options="companyStatusFilterValues"
            :multiple="false"
            :disable-branch-nodes="true"
            :placeholder="$t('tree_selects.verifiedCompanies')"
          />
        </DisclosurePanel>
      </Disclosure>
    </div>
  </div>
</template>
