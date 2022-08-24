<template>
  <div
    class="bg-white overflow-hidden shadow rounded-lg cursor-pointer"
    @click="open = true"
  >
    <div class="px-2 py-3 sm:p-2">
      <tbody class="divide-y divide-gray-200 bg-white overflow-hidden py-5">
        <tr>
          <td class="whitespace-nowrap py-4 pl-1 pr-3 text-sm sm:pl-1">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <img
                  class="h-20 w-20 rounded-lg border-2"
                  :src="props.image"
                  alt=""
                />
              </div>
              <div class="ml-4">
                <div class="font-medium text-lg text-gray-900">
                  {{ props.name }}
                </div>
                <div class="text-gray-500">{{ props.email }}</div>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </div>
  </div>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="open = false">
      <div class="fixed inset-0" />

      <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 inset-y-12 overflow-hidden">
          <div
            class="pointer-events-none fixed inset-y-12 right-0 flex max-w-full pl-10"
          >
            <TransitionChild
              as="template"
              enter="transform transition ease-in-out duration-500 sm:duration-700"
              enter-from="translate-x-full"
              enter-to="translate-x-0"
              leave="transform transition ease-in-out duration-500 sm:duration-700"
              leave-from="translate-x-0"
              leave-to="translate-x-full"
            >
              <DialogPanel class="pointer-events-auto w-screen max-w-md">
                <div
                  class="flex h-screen flex-col overflow-y-scroll bg-gray-50 py-6 shadow-xl"
                >
                  <div class="px-4 sm:px-6">
                    <div class="flex items-start justify-between">
                      <img
                        class="h-16 w-16 rounded-lg border-2"
                        :src="props.image"
                        alt=""
                      />
                      <DialogTitle class="text-lg font-medium text-gray-900">
                        {{ props.name }}</DialogTitle
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
                    {{ props.description }}
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
const props = defineProps({
  id: String,
  name: String,
  email: String,
  image: String,
  description: String,
});
</script>
