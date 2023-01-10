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
import { useForm } from "@inertiajs/inertia-vue3";
import { XMarkIcon, PencilIcon } from "@heroicons/vue/24/outline";

const form = useForm();
const props = defineProps({
  company: Object,
});
const open = ref(false);
function EditCompany(id) {
  form.get(route("admin-companies-edit", id));
}
</script>

<template>
  <Button
    @click="open = true"
    class="hover:bg-blue-700 bg-blue-600 focus:ring-blue-500"
    >{{ $t("buttons.more_info_button") }}</Button
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
              <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                <button
                  type="button"
                  class="rounded-md bg-white text-gray-600 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                  @click="open = false"
                >
                  <span class="sr-only">Close</span>
                  <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                </button>
              </div>
              <div>
                <div class="item-center flex">
                  <img
                    class="h-20 w-20 rounded-lg"
                    :src="'/storage/images/' + props.company.logo"
                    alt=""
                  />
                  <div class="flex-col ml-2">
                    <DialogTitle
                      as="h3"
                      class="text-lg font-medium leading-6 text-gray-900"
                      >{{ company.name }}</DialogTitle
                    >
                    <div class="text-gray-600">
                      {{ company.contact_details.email }}
                    </div>
                    <div class="flex mt-3 my-auto item-center text-center">
                      <slot></slot>
                      <div v-if="company.has_signed_papers">
                        <span
                          class="bg-green-100 text-green-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-800"
                        >
                          {{ $t("company_browser.has_signed_papers") }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-3 text-start sm:mt-5">
                  {{ $t("add_company.description") }}
                  <div class="text-gray-600">{{ company.description }}</div>
                </div>
                <div class="flex gap-2 mx-auto">
                  <div class="mt-3 text-start sm:mt-5 mx-3">
                    {{ $t("common_labels.address") }}
                    <div class="text-gray-600">
                      {{ company.location.shortName }}
                    </div>
                  </div>
                  <div class="mt-3 mx-3 text-start sm:mt-5">
                    {{ $t("common_labels.contact") }}
                    <div
                      v-for="item in company.contact_details"
                      :key="item.id"
                      class="text-gray-600"
                    >
                      {{ item }}
                    </div>
                  </div>
                  <div class="mt-3 mx-3 text-start sm:mt-5">
                    {{ $t("common_labels.specialization") }}
                    <div
                      v-for="item in company.specializations"
                      :key="item.id"
                      class="text-gray-600"
                    >
                      {{ item.label }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-5 sm:mt-6">
                <button
                  type="button"
                  class="inline-flex w-full justify-center rounded-md border border-transparent hover:bg-blue-700 bg-blue-600 focus:ring-blue-500 px-4 py-2 text-base font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 sm:text-sm"
                  @click="EditCompany(company.id)"
                >
                  <PencilIcon class="h-5 w-auto mr-1" />
                  {{ $t("buttons.edit_button") }}
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
