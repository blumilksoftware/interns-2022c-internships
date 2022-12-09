<script setup>
import { ref } from "vue";

import MapGeocode from "./Components/MapGeocode.vue";
import MarkdownEditor from "@/js/Shared/Components/MarkdownEditor.vue";
import Treeselect, { __esModule } from "@tkmam1x/vue3-treeselect";
import "@tkmam1x/vue3-treeselect/dist/vue3-treeselect.css";
import StepBar from "@/js/Shared/Components/StepBar.vue";
import useSteps from "@/js/Shared/Components/useSteps.js";

import {
  MapPinIcon,
  BuildingOffice2Icon,
  PencilSquareIcon,
} from "@heroicons/vue/24/solid";

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

const createCompanyForm = ref(null);

function submitForm() {
  const node = createCompanyForm.value.node;
  node.submit();
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
            ref="createCompanyForm"
          >
            <!-- sekcja 1 -->
            <section class="section-step" v-show="activeStep === 'info'">
              <FormKit type="group" id="info" name="info">
                <div
                  class="flex justify-center items-center gap-8 flex-col md:flex-row"
                >
                  <div
                    class="border border-black aspect-[1/1] rounded-xl w-full max-w-[250px] ssm:w-80"
                  >
                    test
                  </div>
                  <div class="flex flex-col gap-3 w-full ssm:w-80">
                    <FormKit
                      type="text"
                      label="Nazwa firmy"
                      placeholder="Wprowadź nazwę firmy"
                      validation="required"
                    />
                    <FormKit
                      type="text"
                      label="E-mail firmowy"
                      placeholder="Wprowadź e-mail do kontaktu"
                    />
                    <FormKit
                      type="text"
                      label="Numer telefonu"
                      placeholder="Na przykład: 123-456-789"
                    />
                    <FormKit
                      type="text"
                      label="Strona internetowa"
                      placeholder="Na przykład: https://example.com"
                    />
                  </div>
                </div>
              </FormKit>
            </section>
            <!-- sekcja 2 -->
            <section class="section-step" v-show="activeStep === 'address'">
              <FormKit type="group" id="address" name="address">
                <div
                  class="flex justify-center items-center gap-8 flex-col-reverse md:flex-row"
                >
                  <div class="flex flex-col gap-3 w-full ssm:w-80">
                    <FormKit type="text" label="Kraj" />
                    <FormKit type="text" label="Województwo" />
                    <FormKit type="text" label="Miasto" />
                    <FormKit type="text" label="Kod pocztowy" />
                    <FormKit type="text" label="Ulica" validation="required" />
                  </div>
                  <div class="border aspect-[1/1] rounded-xl w-full ssm:w-80">
                    <MapGeocode ref="map" class="rounded-lg" />
                  </div>
                </div>
              </FormKit>
            </section>
            <!-- sekcja 3 -->
            <section class="section-step" v-show="activeStep === 'description'">
              <FormKit type="group" id="description" name="description">
                <div
                  class="flex justify-center items-center flex-col md:flex-row"
                >
                  <MarkdownEditor
                    :preview="false"
                    class="!h-64 md:!h-96 !w-full max-w-lg"
                    v-model="test"
                  />
                  <MarkdownEditor
                    :previewOnly="true"
                    class="!h-64 md:!h-96 !w-full !p-5 max-w-lg"
                    v-model="test"
                  />
                </div>
              </FormKit>
              <Teleport to=".step-buttons" v-if="activeStep === 'description'">
                <FormKit type="submit" @click="submitForm">
                  Prześlij formularz
                </FormKit>
              </Teleport>
            </section>
          </FormKit>
        </template>
      </StepBar>
    </div>
  </div>
</template>
