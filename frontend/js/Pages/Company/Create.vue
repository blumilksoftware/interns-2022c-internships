<script setup>
import { ref } from "vue";
import ImageUploader from "@/js/Shared/Components/ImageUploader.vue";
import MarkdownEditor from "@/js/Shared/Components/MarkdownEditor.vue";
import { camel2title } from "./utils.js";
import useSteps from "./useSteps.js";
import { CheckIcon, ExclamationCircleIcon } from '@heroicons/vue/solid';

const { steps, activeStep, stepPlugin, setStep, visitedSteps } = useSteps();
const text = ref("# Hello Editor");

const checkStepValidity = (stepName) => {
  return (steps[stepName].errorCount > 0 || steps[stepName].blockingCount > 0) && visitedSteps.value.includes(stepName)
}

defineProps({
  image: File,
});
</script>

<template>
  <FormKit
      type="form"
      #default="{ value, state: { valid }}"
      :plugins="[stepPlugin]"
      :actions="false"
  >

    <nav aria-label="Progress">
      <ol role="list" class="bg-white divide-y divide-gray-300 rounded-md border border-gray-300 md:flex md:divide-y-0">
        <li
            v-for="(step, stepName, index) in steps"
            @click="activeStep = stepName"

            class="relative md:flex md:flex-1"
        >
          <a
              v-if="step.valid"
              :href="step.href"
              class="group flex w-full items-center"
          >
          <span class="flex items-center px-6 py-4 text-sm font-medium">
            <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-primary group-hover:bg-secondary">
              <CheckIcon class="h-6 w-6 text-white" aria-hidden="true" />
            </span>
            <span class="ml-4 text-sm font-medium text-gray-900">{{ camel2title(stepName) }}</span>
          </span>
          </a>
          <a
              v-else-if="activeStep === stepName"
              :href="step.href"
              class="flex items-center px-6 py-4 text-sm font-medium"
              aria-current="step"
          >
          <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-primary">
            <span class="text-primary">{{ index + 1 }}</span>
          </span>
            <span class="ml-4 text-sm font-medium text-primary">{{ camel2title(stepName) }}</span>
          </a>
          <a
              v-else-if="checkStepValidity(stepName)"
              :href="step.href"
              class="group flex w-full items-center"
          >
          <span class="flex items-center px-6 py-4 text-sm font-medium">
            <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-primary group-hover:bg-secondary">
              <ExclamationCircleIcon class="h-6 w-6 text-white" aria-hidden="true" />
            </span>
            <span class="ml-4 text-sm font-medium text-gray-900">{{ camel2title(stepName) }}</span>
          </span>
          </a>
          <a
              v-else
              :href="step.href"
              class="group flex items-center"
          >
          <span class="flex items-center px-6 py-4 text-sm font-medium">
            <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
              <span class="text-gray-500 group-hover:text-gray-900">{{ index + 1 }}</span>
            </span>
            <span class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">{{ camel2title(stepName) }}</span>
          </span>
          </a>
          <template
              v-if="index !== 2"
          >
            <!-- Arrow separator for lg screens and up -->
            <div class="absolute top-0 right-0 hidden h-full w-5 md:block" aria-hidden="true">
              <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
                <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
              </svg>
            </div>
          </template>
        </li>
      </ol>

    </nav>


    <div class="max-h-full flex justify-center pt-8">
      <!-- 1 panel -->
      <section v-show="activeStep === 'companyInfo'">
        <FormKit type="group" id="companyInfo" name="companyInfo">
          <label>Logo</label>
          <ImageUploader v-model="image"/>

          <label>Nazwa firmy</label>
          <FormKit
              type="text"
              validation="required|length:2,255"
          />

          <label>E-mail</label>
          <FormKit
              type="email"
              validation="required|email"
          />

          <label>Numer telefonu</label>
          <FormKit
              type="text"
          />

          <label>Strona www</label>
          <FormKit
              type="url"
              validation="url"
          />
        </FormKit>
      </section>

      <!-- 2 panel -->
      <section v-show="activeStep === 'companyAddress'">
        <div class="flex flex-col-reverse md:flex-row">
          <div>
            <FormKit type="group" id="companyAddress" name="companyAddress">
              <label>Państwo</label>
              <FormKit
                  type="text"
                  validation="required"
              />

              <label>Województwo</label>
              <FormKit
                  type="text"
                  validation="required"
              />

              <label>Miasto</label>
              <FormKit
                  type="text"
                  validation="required"
              />

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
          </div>
          <div>
            [[mapa]]
          </div>

        </div>
      </section>

      <!-- 3 panel -->
      <section v-show="activeStep === 'companyDescription'">
        <FormKit type="group" id="companyDescription" name="companyDescription">
          <label>Opis firmy</label>
          <MarkdownEditor v-model="text" />
          <FormKit
              type="text"
              validation="required"
          />
        </FormKit>
      </section>
    </div>

    <div class="flex flex-col items-center justify-center md:flex-row">
        <FormKit type="button" :disabled="activeStep === 'companyInfo'" @click="setStep(-1)" v-text="'< ' + 'Previous step'" />
        <div class=""><FormKit type="submit" label="Submit Application" :disabled="!valid" /></div>
        <div class="order-first md:order-last"><FormKit type="button" class="next" :disabled="activeStep === 'companyDescription' " @click="setStep(1)" v-text="'Next step' + ' >'"/></div>
    </div>

  </FormKit>

</template>

<style>

</style>