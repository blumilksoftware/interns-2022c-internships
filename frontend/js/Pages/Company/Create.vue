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
import {
  MapPinIcon,
  BuildingOffice2Icon,
  PencilSquareIcon,
} from "@heroicons/vue/24/solid";

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

const icons = {
  info: BuildingOffice2Icon,
  address: MapPinIcon,
  description: PencilSquareIcon,
};

const { steps, stepPlugin } = useSteps();

const activeStep = ref("info");

function onActiveStepChange(stepName) {
  activeStep.value = stepName;
}
</script>
<template>
  <div class="flex justify-center sm:p-6">
    <div class="w-full max-w-screen-xl bg-white rounded-xl p-6 ssm:p-10">
      <StepBar @stepChanged="onActiveStepChange" :steps="steps" :icons="icons">
        <template v-slot:content>
          <FormKit
            type="form"
            #default="{ state: { valid } }"
            :plugins="[stepPlugin]"
            :actions="false"
          >
            <section class="section-step" v-show="activeStep === 'info'">
              <FormKit type="group" id="info" name="info">
                <div
                  class="flex justify-center items-center gap-8 flex-col md:flex-row"
                >
                  <div
                    class="border-2 border-gray-400 aspect-[1/1] rounded-xl w-full max-w-[250px] ssm:w-80"
                  >
                    <ImageUploader
                      class="h-full w-full flex items-center justify-center"
                      v-model="form.logoFile"
                    />
                  </div>

                  <div class="flex flex-col gap-3 w-full ssm:w-80">
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

                    <InputError :message="form.errors.contact_details" />
                    <InputError class="mt-2" :message="form.errors.logoFile" />
                  </div>
                </div>
              </FormKit>
            </section>

            <section class="section-step" v-show="activeStep === 'address'">
              <FormKit type="group" id="address" name="address">
                <div
                  class="flex justify-center items-center gap-8 flex-col-reverse md:flex-row"
                >
                  <div class="flex flex-col gap-3 w-full ssm:w-80">
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
                  </div>
                  <div class="w-full ssm:w-80">
                    <div class="border aspect-[1/1] rounded-xl">
                      <MapGeocode ref="map" class="rounded-lg" />
                    </div>
                    <FormKit type="button" @click="generateCoordinates">
                      {{ $t("add_company.generate_button") }}
                    </FormKit>
                  </div>
                </div>
              </FormKit>
            </section>

            <section class="section-step" v-show="activeStep === 'description'">
              <FormKit type="group" id="description" name="description">
                <div
                  class="flex justify-center items-center flex-col md:flex-row"
                >
                  <MarkdownEditor
                    :preview="false"
                    class="!h-64 md:!h-96 !w-full max-w-lg"
                    v-model="form.description"
                  />
                  <div
                    class="!h-64 md:!h-96 !w-full !p-5 max-w-lg border-2 border-gray-100"
                  >
                    <MarkdownEditor
                      :previewOnly="true"
                      v-model="form.description"
                    />
                  </div>
                </div>

                <FormKit
                  type="hidden"
                  v-model="form.description"
                  validation="required"
                />
                <InputError :message="form.errors.description" />

                <div class="flex items-center flex-col pt-5">
                  <label>{{ $t("add_company.select_specializations") }} </label>
                  <Treeselect
                    class="max-w-md"
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
                </div>
              </FormKit>
              <Teleport to=".step-buttons" v-if="activeStep === 'description'">
                <FormKit
                  type="submit"
                  @click="submit"
                  :disabled="form.processing || !valid"
                >
                  {{ $t("add_company.submit_button") }}
                </FormKit>
              </Teleport>
            </section>
          </FormKit>
        </template>
      </StepBar>
    </div>
  </div>
</template>
