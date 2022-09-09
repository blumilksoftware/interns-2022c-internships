<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/js/Shared/Components/InputError.vue";
import { ref } from "vue";
import ImageUploader from "@/js/Shared/Components/ImageUploader.vue";
import MarkdownEditor from "@/js/Shared/Components/MarkdownEditor.vue";
import useSteps from "./useSteps.js";
import { CheckIcon, ExclamationCircleIcon } from '@heroicons/vue/solid';
import MapGeocode from "./Components/MapGeocode.vue";
import Treeselect from "@tkmam1x/vue3-treeselect";
import "@tkmam1x/vue3-treeselect/dist/vue3-treeselect.css";

const props = defineProps({
  departments: Array,
});

const form = useForm({
  name: null,
  description: "",
  logoFile: null,
  specializations: null,
  address: {
    street: null,
    city: null,
    postal_code: null,
    voivodeship: null,
    country: null,
    coordinates: null,
  },
  contact_details: {
    email: null,
    website_url: null,
    phone_number: null,
  },
});

function submit() {
  form.address.coordinates = getCoordinatesFromMap();
  form.post(route("company-store"), {
    _method: 'put',
  });
}

const { steps, activeStep, stepPlugin, setStep, visitedSteps } = useSteps();
const text = ref("# Hello Editor");
let map = ref();

const checkStepValidity = (stepName) => {
  return (steps[stepName].errorCount > 0 || steps[stepName].blockingCount > 0) && visitedSteps.value.includes(stepName)
}

function getLocationFromInputs(){
  return [
    form.address.street,
    form.address.city,
    form.address.voivodeship,
    form.address.country,
    form.address.postal_code,
  ].join(", ")
}

function generateCoordinates(){
  map.value.find(getLocationFromInputs());
}

function getCoordinatesFromMap(){
  let coords = map.value.getCoordinates();

  return {
    latitude: coords.lat,
    longitude: coords.lng,
  }
}
</script>

<template>
  <div class="w-full h-full">
    <FormKit
        type="form"
        #default="{ value, state: { valid }}"
        :plugins="[stepPlugin]"
        :actions="false"
    >

      <nav aria-label="Progress">
        <ol role="list" class="flex bg-white divide-y-0 divide-gray-300 border border-gray-300">
          <li
              v-for="(step, stepName, index) in steps"
              @click="activeStep = stepName"

              class="relative flex flex-1"
          >
            <a
                v-if="step.valid"
                :href="step.href"
                class="group flex w-full items-center"
            >
          <span class="flex items-center px-6 py-2 text-sm font-medium md:py-4">
            <span class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-primary group-hover:bg-secondary md:h-10 md:w-10">
              <CheckIcon class="h-4 w-4 text-white md:h-6 md:w-6" aria-hidden="true" />
            </span>
            <span class="ml-4 text-sm font-medium text-gray-900">{{ $t("add_company.step_" + stepName) }}</span>
          </span>
            </a>
            <a
                v-else-if="activeStep === stepName"
                :href="step.href"
                class="flex items-center px-6 py-2 text-sm font-medium md:py-4"
                aria-current="step"
            >
          <span class="flex h-6 w-6 bg-primary flex-shrink-0 items-center justify-center rounded-full border-2 border-primary md:h-10 md:w-10">
            <span class="text-white">{{ index + 1 }}</span>
          </span>
              <span class="ml-4 text-sm font-medium text-primary">{{ $t("add_company.step_" + stepName) }}</span>
            </a>
            <a
                v-else-if="checkStepValidity(stepName)"
                :href="step.href"
                class="group flex w-full items-center"
            >
          <span class="flex items-center px-6 py-2 text-sm font-medium md:py-4">
            <span class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-red-700 group-hover:bg-red-800 md:h-10 md:w-10">
              <ExclamationCircleIcon class="h-10 w-10 text-white" aria-hidden="true" />
            </span>
            <span class="ml-4 text-sm font-medium text-gray-900">{{ $t("add_company.step_" + stepName) }}</span>
          </span>
            </a>
            <a
                v-else
                :href="step.href"
                class="group flex items-center"
            >
          <span class="flex items-center px-6 py-2 text-sm font-medium md:py-4">
            <span class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400 md:h-10 md:w-10">
              <span class="text-gray-500 group-hover:text-gray-900">{{ index + 1 }}</span>
            </span>
            <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">{{ $t("add_company.step_" + stepName) }}</span>
          </span>
            </a>
            <template
                v-if="index !== 2"
            >
              <!-- Arrow separator for lg screens and up -->
              <div class="absolute top-0 right-0 h-full w-5 md:block">
                <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                  <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
                </svg>
              </div>
            </template>
          </li>
        </ol>
      </nav>

      <div class="w-full h-full flex flex-column items-center">
        <div class="w-full flex flex-col items-center pt-8">
          <!-- 1 panel -->
          <section class="flex flex-col items-center w-full md:w-auto" v-show="activeStep === 'info'">
            <label>{{ $t("add_company.logo") }}</label>
            <ImageUploader class="h-52 w-52" v-model="form.logoFile"/>
            <InputError class="mt-2" :message="form.errors.logoFile" />

            <FormKit type="group" id="info" name="info">
              <FormKit
                  v-model="form.name"
                  type="text"
                  :label='$t("add_company.company_name")'
                  validation="required|length:2,255"
              />
              <InputError class="mt-2" :message="form.errors.name" />

              <FormKit
                  v-model="form.contact_details.email"
                  type="email"
                  :label='$t("add_company.email")'
                  validation="required|email"
              />
              <InputError class="mt-2" :message="form.errors.contact_details" />

              <FormKit
                  v-model="form.contact_details.phone_number"
                  :label='$t("add_company.phone_number")'
                  type="text"
              />

              <FormKit
                  v-model="form.contact_details.website_url"
                  type="url"
                  :label='$t("add_company.website_url")'
                  validation="url"
              />
            </FormKit>
          </section>

          <!-- 2 panel -->
          <section class="flex flex-col items-center w-full md:w-auto" v-show="activeStep === 'address'">
            <FormKit type="group" id="address" name="address">
              <div class="flex flex-col-reverse md:flex-row">
                <div>
                  <FormKit
                      v-model="form.address.country"
                      id="country"
                      :label='$t("add_company.country")'
                      type="text"
                      validation="required"
                  />

                  <FormKit
                      v-model="form.address.voivodeship"
                      id="voivodeship"
                      :label='$t("add_company.voivodeship")'
                      type="text"
                      validation="required"
                  />

                  <FormKit
                      v-model="form.address.city"
                      id="city"
                      :label='$t("add_company.city")'
                      type="text"
                      validation="required"
                  />

                  <FormKit
                      v-model="form.address.postal_code"
                      :label='$t("add_company.postal_code")'
                      id="postal_code"
                      type="text"
                      validation="required"
                  />

                  <FormKit
                      v-model="form.address.street"
                      :label='$t("add_company.street_address")'
                      id="street"
                      type="text"
                      validation="required"
                  />
                  <InputError class="mt-2" :message="form.errors.address" />

                  <FormKit
                      :help='$t("add_company.set_marker")'
                      type="button"
                      @click="generateCoordinates"
                  >
                    {{ $t("add_company.generate_button") }}
                  </FormKit>
                </div>
                <div class="pl-0 md:pl-5 h-96 w-full md:w-96">
                  <MapGeocode ref="map" />
                </div>
              </div>
            </FormKit>
          </section>

          <!-- 3 panel -->
          <section class="flex flex-col items-center w-full md:w-auto" v-show="activeStep === 'description'">
            <FormKit type="group" id="description" name="description">
              <label>{{ $t("add_company.description") }}</label>
              <MarkdownEditor class="flex w-screen sticky" v-model="form.description" />
              <FormKit
                  type="hidden"
                  v-model="form.description"
                  validation="required"
              />
              <InputError class="mt-2" :message="form.errors.description" />

              <label>{{ $t("add_company.select_specializations") }}</label>
              <Treeselect
                  class="mt-2 w-96"
                  :options="props.departments.data"
                  :multiple="true"
                  :disable-branch-nodes="true"
                  :placeholder="$t('tree_selects.tree_select_specialization')"
                  search-nested
                  v-model="form.specializations"
              />
            </FormKit>
          </section>
        </div>
      </div>
      <div class="flex flex-col w-full items-center">
        <div class="flex flex-col md:flex-row items-center">
          <FormKit
              type="button"
              :disabled="activeStep === 'info'"
              @click="setStep(-1)"
              v-text="'< ' + $t('add_company.previous_step_button')"
          />
          <FormKit
              type="button"
              class="next"
              :disabled="activeStep === 'description' "
              @click="setStep(1)"
              v-text="$t('add_company.next_step_button') + ' >'"
          />
        </div>
        <FormKit
            class="flex flex-col"
            type="submit"
            :disabled="form.processing || !valid"
            @click="submit"
        >
          {{ $t("buttons.request_button") }}
        </FormKit>
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
          {{ form.progress.percentage }}%
        </progress>
      </div>
    </FormKit>
  </div>
</template>

<style>

</style>