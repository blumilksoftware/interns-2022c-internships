<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import ImageUploader from "@/js/Shared/Components/ImageUploader.vue";
import MarkdownEditor from "@/js/Shared/Components/MarkdownEditor.vue";
import { camel2title } from "./utils.js";
import useSteps from "./useSteps.js";
import { CheckIcon, ExclamationCircleIcon } from '@heroicons/vue/solid';
import MapGeocode from "./Components/MapGeocode.vue";

const form = useForm({
  name: null,
  description: "",
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
    onFinish: () => form.reset(),
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

defineProps({
  image: File,
});

let valid = false;
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
          <span class="flex items-center px-6 py-2 text-sm font-medium">
            <span class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-primary group-hover:bg-secondary md:h-10 md:w-10">
              <CheckIcon class="h-4 w-4 text-white md:h-6 md:w-6" aria-hidden="true" />
            </span>
            <span class="ml-4 text-sm font-medium text-gray-900">{{ camel2title(stepName) }}</span>
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
              <span class="ml-4 text-sm font-medium text-primary">{{ camel2title(stepName) }}</span>
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
            <span class="ml-4 text-sm font-medium text-gray-900">{{ camel2title(stepName) }}</span>
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
            <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">{{ camel2title(stepName) }}</span>
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
            <label>Logo</label>
            <ImageUploader class="h-52 w-52" v-model="image"/>

            <FormKit type="group" id="info" name="info">
              <FormKit
                  v-model="form.name"
                  type="text"
                  label="Nazwa firmy"
                  validation="required|length:2,255"
              />

              <FormKit
                  v-model="form.contact_details.email"
                  type="email"
                  label="E-Mail Firmowy"
                  validation="required|email"
              />

              <FormKit
                  v-model="form.contact_details.phone_number"
                  label="Telefon"
                  type="text"
              />

              <FormKit
                  v-model="form.contact_details.website_url"
                  type="url"
                  label="Strona internetowa"
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
                          label="Kraj"
                          type="text"
                          validation="required"
                      />

                      <FormKit
                          v-model="form.address.voivodeship"
                          id="voivodeship"
                          label="Województwo"
                          type="text"
                          validation="required"
                      />

                      <FormKit
                          v-model="form.address.city"
                          id="city"
                          label="Miasto"
                          type="text"
                          validation="required"
                      />

                      <FormKit
                          v-model="form.address.postal_code"
                          label="Kod pocztowy"
                          id="postal_code"
                          type="text"
                          validation="required"
                      />

                      <FormKit
                          v-model="form.address.street"
                          label="Ulica"
                          id="street"
                          type="text"
                          validation="required"
                      />

                      <FormKit
                          help="Ustaw marker na mapie"
                          type="button"
                          @click="generateCoordinates"
                      >
                        Generuj
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
              <label>Opis firmy</label>
              <MarkdownEditor class="flex w-screen sticky" v-model="form.description" />
              <FormKit
                  type="hidden"
                  v-model="form.description"
                  validation="required"
              />
            </FormKit>
          </section>
          </div>
        </div>
      </FormKit>
    <div class="flex flex-col w-full items-center">
      <div class="flex flex-col md:flex-row items-center">
        <FormKit type="button" :disabled="activeStep === 'info'" @click="setStep(-1)" v-text="'< ' + 'Previous step'" />
        <FormKit type="button" class="next" :disabled="activeStep === 'description' " @click="setStep(1)" v-text="'Next step' + ' >'"/>
      </div>
      <FormKit
          class="flex flex-col"
          type="submit"
          :disabled="form.processing && !valid"
          @click="submit"
      >
        {{ $t("buttons.request_button") }}
      </FormKit>
    </div>
  </div>
</template>

<style>

</style>