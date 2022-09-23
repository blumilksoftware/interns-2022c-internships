<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/js/Shared/Components/InputError.vue";
import { ref, watch } from "vue";
import ImageUploader from "@/js/Shared/Components/ImageUploader.vue";
import MarkdownEditor from "@/js/Shared/Components/MarkdownEditor.vue";
import MapGeocode from "./Components/MapGeocode.vue";
import Treeselect from "@tkmam1x/vue3-treeselect";
import "@tkmam1x/vue3-treeselect/dist/vue3-treeselect.css";
import { useI18n } from "vue-i18n";
import { useToast } from "vue-toastification";
import StepBar from "@/js/Shared/Components/StepBar.vue";
import useSteps from "@/js/Shared/Components/useSteps.js";

const i18n = useI18n();
const toast = useToast();

const props = defineProps({
  departments: Object,
});

const form = useForm({
  name: null,
  description: "*" + i18n.t("add_company.description_info") + "*",
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

const specializationLimit = 4;
let toastLimiter = false;

function showSelectError() {
  if (!toastLimiter) {
    toast.error(i18n.t("status.cannot_select_more"));
    toastLimiter = true;
  } else {
    return;
  }
  setTimeout(function () {
    toastLimiter = false;
  }, 3000);
}

watch(
  () => form.specializations,
  () => {
    if (
      form.specializations &&
      form.specializations.length > specializationLimit
    ) {
      showSelectError();
      form.specializations = form.specializations.slice(0, specializationLimit);
    }
  },
  { deep: true }
);

function submit() {
  form.address.coordinates = getCoordinatesFromMap();
  form.post(route("company-store"), {
    _method: "put",
  });
}

let map = ref();

function getLocationFromInputs() {
  return [
    form.address.street,
    form.address.city,
    form.address.voivodeship,
    form.address.country,
    form.address.postal_code,
  ].join(", ");
}

function generateCoordinates() {
  map.value.find(getLocationFromInputs());
}

function getCoordinatesFromMap() {
  let coords = map.value.getCoordinates();

  return {
    latitude: coords.lat,
    longitude: coords.lng,
  };
}

const { steps, stepPlugin } = useSteps();

const activeStep = ref("info");

function onActiveStepChange(stepName) {
  activeStep.value = stepName;
}
</script>
<template>
  <div class="w-full h-full">
    <StepBar @stepChanged="onActiveStepChange" :steps="steps">
      <template v-slot:content>
        <FormKit
          type="form"
          #default="{ state: { valid } }"
          :plugins="[stepPlugin]"
          :actions="false"
        >
          <div
            class="flex flex-col w-full h-full items-center justify-center p-8 gap-3 md:w-auto"
          >
            <section class="flex flex-col items-center w-full" v-show="activeStep === 'info'">
              <label>{{ $t("add_company.logo") }}</label>
              <ImageUploader class="h-52 w-52" v-model="form.logoFile" />
              <InputError class="mt-2" :message="form.errors.logoFile" />

              <FormKit type="group" id="info" name="info">
                <FormKit
                  v-model="form.name"
                  type="text"
                  :label="$t('add_company.company_name')"
                  validation="required|length:2,255"
                />
                <InputError :message="form.errors.name" />

                <FormKit
                  v-model="form.contact_details.email"
                  type="email"
                  :label="$t('add_company.email')"
                  validation="required|email"
                />
                <InputError :message="form.errors.contact_details" />

                <FormKit
                  v-model="form.contact_details.phone_number"
                  :label="$t('add_company.phone_number')"
                  type="text"
                />

                <FormKit
                  v-model="form.contact_details.website_url"
                  type="url"
                  :label="$t('add_company.website_url')"
                  validation="url"
                />
              </FormKit>
            </section>

            <section class="flex flex-col items-center w-full" v-show="activeStep === 'address'">
              <FormKit type="group" id="address" name="address">
                <div class="flex flex-col-reverse lg:flex-row">
                  <div>
                    <FormKit
                      v-model="form.address.country"
                      id="country"
                      :label="$t('add_company.country')"
                      type="text"
                      validation="required"
                    />

                    <FormKit
                      v-model="form.address.voivodeship"
                      id="voivodeship"
                      :label="$t('add_company.voivodeship')"
                      type="text"
                      validation="required"
                    />

                    <FormKit
                      v-model="form.address.city"
                      id="city"
                      :label="$t('add_company.city')"
                      type="text"
                      validation="required"
                    />

                    <FormKit
                      v-model="form.address.postal_code"
                      :label="$t('add_company.postal_code')"
                      id="postal_code"
                      type="text"
                      validation="required"
                    />

                    <FormKit
                      v-model="form.address.street"
                      :label="$t('add_company.street_address')"
                      id="street"
                      type="text"
                      validation="required"
                    />
                    <InputError :message="form.errors.address" />

                    <FormKit
                      :help="$t('add_company.set_marker')"
                      type="button"
                      @click="generateCoordinates"
                    >
                      {{ $t("add_company.generate_button") }}
                    </FormKit>
                  </div>
                  <div class="pl-0 lg:pl-5 h-96 w-full lg:w-96">
                    <MapGeocode ref="map" class="rounded-lg" />
                  </div>
                </div>
              </FormKit>
            </section>

            <section class="flex flex-col items-center w-full" v-show="activeStep === 'description'">
              <FormKit type="group" id="description" name="description">
                <label>{{ $t("add_company.description") }}</label>
                <div class="flex flex-col items-center justify-center xl:flex-row w-full h-full pt-2">
                  <MarkdownEditor
                    :preview="false"
                    class="!h-64 md:!h-96 !w-4/5 max-w-md"
                    v-model="form.description"
                  />
                  <MarkdownEditor
                    :previewOnly="true"
                    class="!h-64 md:!h-96 !w-4/5 !p-5 max-w-md"
                    v-model="form.description"
                  />
                </div>
                <FormKit
                  type="hidden"
                  v-model="form.description"
                  validation="required"
                />
                <InputError :message="form.errors.description" />

                <label class="pt-5">{{
                  $t("add_company.select_specializations")
                }}</label>
                <Treeselect
                  class="mt-2 w-96"
                  :options="props.departments.data"
                  :multiple="true"
                  :disable-branch-nodes="true"
                  :placeholder="$t('tree_selects.tree_select_specialization')"
                  search-nested
                  v-model="form.specializations"
                />
                <FormKit
                  type="hidden"
                  v-model="form.specializations"
                  validation="required"
                />
              </FormKit>
            </section>
          </div>

          <div class="flex flex-row justify-center">
            <FormKit
              type="submit"
              @click="submit"
              :disabled="form.processing || !valid"
            >
              {{ $t("buttons.request_button") }}
            </FormKit>
            <progress
              v-if="form.progress"
              :value="form.progress.percentage"
              max="100"
            >
              {{ form.progress.percentage }}%
            </progress>
          </div>
        </FormKit>
      </template>
    </StepBar>
  </div>
</template>
