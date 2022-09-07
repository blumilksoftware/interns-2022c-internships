<script setup>
import { ref } from "vue";
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import Button from "@/js/Shared/Components/Button.vue";
import { DocumentTextIcon, PencilIcon } from "@heroicons/vue/outline";

const props = defineProps({
  company: Object,
});
const open = ref(false);
</script>

<template>
  <Button
    @click="open = true"
    class="hover:bg-blue-700 bg-blue-600 focus:ring-blue-500"
    >More</Button
  >
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="open = false">
      <TransitionChild
        as="template"
        enter="ease-out duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in duration-200"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div
          class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        />
      </TransitionChild>

      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div
          class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
        >
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          >
            <DialogPanel
              class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-5xl sm:p-6"
            >
              <div>
                <div
                  class=" item-center flex"
                >
                <img
                          class="h-20 w-20 rounded-lg"
                          :src="'/storage/images/' + company.logo"
                          alt=""
                        />
                      <div class="flex-col ml-2">
                        <DialogTitle
                    as="h3"
                    class="text-lg  font-medium leading-6 text-gray-900"
                    >{{ company.name }}</DialogTitle
                  > 
                  <div class="text-gray-400">{{ company.contact_details.email }}</div>
                  <div class="flex mt-3">
                    <slot ></slot>
                  <DocumentTextIcon v-if="company.has_signed_papers" class="h-5 ml-3 w-auto" />
                  </div>
                  
                      </div>
                </div>
                <div class="mt-3 text-start sm:mt-5">
                  Description
                  <div class="text-gray-400">{{ company.description }}</div>
                </div>
                <div class="flex gap-2 mx-auto">
                  <div class="mt-3 text-start sm:mt-5">
                  Address
                  <div v-for="item in company.address" class="text-gray-400">{{ item }}</div>
                </div>
                <div class="mt-3 text-start sm:mt-5">
                  Contact
                  <div v-for="item in company.contact_details" class="text-gray-400">{{ item }}</div>
                </div>
                <div class="mt-3 text-start sm:mt-5">
                  Specializations
                  <div v-for="item in company.specializations" class="text-gray-400">{{ item.label }}</div>
                </div>
                </div>
              </div>
              <div class="mt-5 sm:mt-6">
                <button
                  type="button"
                  class="inline-flex w-full justify-center rounded-md border border-transparent hover:bg-blue-700 bg-blue-600 focus:ring-blue-500 px-4 py-2 text-base font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 sm:text-sm"
                  @click="open = false"
                >
                <PencilIcon class="h-5 w-auto mr-1"/> Edit
                </button>
                <button
                  type="button"
                  class="inline-flex w-full mt-3 justify-center rounded-md border border-transparent hover:bg-slate-700 bg-slate-600 focus:ring-slate-500 px-4 py-2 text-base font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 sm:text-sm"
                  @click="open = false"
                >
                  Close
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
