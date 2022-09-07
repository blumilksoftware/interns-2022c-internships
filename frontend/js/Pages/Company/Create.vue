<script setup>
import { ref } from "vue";
import ImageUploader from "@/js/Shared/Components/ImageUploader.vue";
import MdEditor from "md-editor-v3";
import "md-editor-v3/lib/style.css";
import { camel2title } from "./utils.js";
import useSteps from "./useSteps.js";

const { steps, activeStep, stepPlugin } = useSteps();
const text = ref("# Hello Editor");

defineProps({
  image: File,
});
</script>

<template>
  <FormKit type="form" #default="{ value }" :plugins="[stepPlugin]">

<!--
    <ul class="steps">
      <li
        v-for="(step, stepName) in steps"
        class="step"
        @click="activeStep = stepName"
        :data-step-valid="step.valid"
        :data-step-active="activeStep === stepName"
      >
        {{ camel2title(stepName) }}
      </li>
    </ul>
-->

    <nav aria-label="Progress">
      <ol role="list" class="space-y-4 md:flex md:space-y-0 md:space-x-8">
        <li
            v-for="(step, stepName, index) in steps"
            @click="activeStep = stepName"

            class="md:flex-1"
        >
          <a
              v-if="step.valid"
              :href="step.href"
              class="group flex flex-col border-l-4 border-green-600 py-2 pl-4 hover:border-green-800 md:border-l-0 md:border-t-4 md:pl-0 md:pt-4 md:pb-0"
          >
            <span class="text-sm font-medium text-indigo-600 group-hover:text-indigo-800">Step {{ index + 1 }}</span>
            <span class="text-sm font-medium">{{ camel2title(stepName) }}</span>
          </a>


          <a
              v-else-if="activeStep === stepName"
              :href="step.href"
              class="flex flex-col border-l-4 border-indigo-600 py-2 pl-4 md:border-l-0 md:border-t-4 md:pl-0 md:pt-4 md:pb-0"
              aria-current="step"
          >
            <span class="text-sm font-medium text-indigo-600">Step {{ index + 1 }}</span>
            <span class="text-sm font-medium">{{ camel2title(stepName) }}</span>
          </a>


          <a
              v-else :href="step.href"
              class="group flex flex-col border-l-4 border-gray-200 py-2 pl-4 hover:border-gray-300 md:border-l-0 md:border-t-4 md:pl-0 md:pt-4 md:pb-0"
          >
            <span class="text-sm font-medium text-gray-500 group-hover:text-gray-700">Step {{ index + 1 }}</span>
            <span class="text-sm font-medium">{{ camel2title(stepName) }}</span>
          </a>
        </li>
      </ol>
    </nav>


    <div class="form-body">
      <!-- 1 panel -->
      <section v-show="activeStep === 'companyInfo'">
        <FormKit type="group" id="companyInfo" name="companyInfo">
          <label>Logo</label>
          <ImageUploader v-model="image"/>

          <label>Nazwa firmy</label>
          <FormKit
              type="text"
              validation="required"
          />

          <label>E-mail</label>
          <FormKit
              type="text"
              validation="required"
          />

          <label>Numer telefonu</label>
          <FormKit
              type="text"
              validation="required"
          />

          <label>Strona www</label>
          <FormKit
              type="text"
              validation="required"
          />
        </FormKit>
      </section>

      <!-- 2 panel -->
      <section v-show="activeStep === 'companyAddress'">
        <FormKit type="group" id="companyAddress" name="companyAddress">
          <label>Państwo</label>
          <FormKit type="select" />

          <label>Województwo</label>
          <FormKit type="select" />

          <label>Miasto</label>
          <FormKit type="select" />

          <label>Kod pocztowy</label>
          <FormKit
              type="text"
              validation="required"
          />

          <label>Ulica</label>
          <FormKit
              type="text"
              validation="required"
          />
        </FormKit>
      </section>

      <!-- 3 panel -->
      <section v-show="activeStep === 'companyDescription'">
        <FormKit type="group" id="companyDescription" name="companyDescription">
          <label>Opis firmy</label>
          <md-editor v-model="text" />
          <FormKit
              type="text"
              validation="required"
          />
        </FormKit>
      </section>

    </div>
  </FormKit>
</template>

<style>
.formkit-form {
  margin: auto;
  padding: 50px;
  width: 40vw;
  height: 40vw;
  flex-shrink: 0;
  background: #fff;
  color: #000;
  border-radius: 0.5em;
  box-shadow: 0.25em 0.25em 1em 0 rgba(0,0,0,0.1);
}
</style>
