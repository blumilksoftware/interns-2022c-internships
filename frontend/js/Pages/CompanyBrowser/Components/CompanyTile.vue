<template>
  <div
    class="bg-white overflow-hidden shadow rounded-lg cursor-pointer"
    @click="open = true"
  >
    <div class="px-2 py-3 sm:p-2">
      <table>
        <tbody class="divide-y divide-gray-200 bg-white overflow-hidden py-5">
          <tr>
            <td class="whitespace-nowrap py-4 pl-1 pr-3 text-sm sm:pl-1">
              <div class="flex items-center">
                <div class="flex-shrink-0">
                  <img
                    class="h-12 w-auto sm:h-20 sm:w-20 rounded-lg border-2"
                    :src="'/storage/images/' + company.logo"
                    alt=""
                  />
                </div>
                <div class="ml-4">
                  <div class="font-medium text-md sm:text-lg text-gray-900">
                    {{ company.name }}
                  </div>
                  <div class="text-gray-500">
                    {{ company.location.shortName }}
                  </div>
                  <div class="mt-2" v-if="company.has_signed_papers">
                    <span
                      class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-800"
                    >
                      {{ $t("company_browser.has_signed_papers") }}
                    </span>
                  </div>
                  <div class="mt-2" v-if="company.status === 'pending_new'">
                    <span
                      class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-800"
                    >
                      {{ $t("company_browser.is_pending") }}
                    </span>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-30" @close="open = false">
      <div class="fixed inset-0" />

      <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 inset-y-1/2 sm:inset-y-12 overflow-hidden">
          <div
            class="pointer-events-none fixed sm:inset-y-12 left-0 mx-auto flex max-w-screen pr-10"
          >
            <TransitionChild
              as="template"
              enter="transform transition ease-in-out duration-500 sm:duration-700"
              enter-from="translate-y-full"
              enter-to="sm:translate-y-50 sm:translate-y-0"
              leave="transform transition ease-in-out duration-500 sm:duration-700"
              leave-from="translate-y-0"
              leave-to="translate-y-full"
            >
              <DialogPanel class="pointer-events-auto w-screen sm:max-w-xl">
                <div
                  class="flex h-screen flex-col overflow-y-scroll bg-gray-50 py-6 shadow-xl"
                >
                  <div class="px-4 sm:px-6">
                    <div class="flex items-start justify-between">
                      <img
                        class="h-16 w-16 rounded-lg border-2"
                        :src="'/storage/images/' + company.logo"
                        alt=""
                      />
                      <DialogTitle class="text-lg font-medium text-gray-900">
                        {{ company.name }}</DialogTitle
                      >
                      <div class="ml-3 flex h-7 items-center">
                        <button
                          type="button"
                          class="rounded-md bg-gray-50 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                          @click="open = false"
                        >
                          <span class="sr-only">Close panel</span>
                          <XIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="relative mt-6 flex-1 px-4 sm:px-6">
                    {{ company.description }}
                  </div>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
<script setup>
import { ref } from "vue";
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { XIcon } from "@heroicons/vue/outline";

const open = ref(false);
defineProps({
  company: Object,
});
</script>
