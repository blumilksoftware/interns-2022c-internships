<script setup>
import { computed, watch, onMounted } from "vue";
import {
  CheckCircleIcon,
  XCircleIcon,
  ChevronDoubleRightIcon,
  ChevronDoubleLeftIcon,
} from "@heroicons/vue/24/solid";
import useSteps from "./useSteps.js";

const { activeStep, visitedSteps } = useSteps();
const props = defineProps({
  steps: Object,
});

const checkStepValidity = (stepName) => {
  return (
    (props.steps[stepName].errorCount > 0 ||
      props.steps[stepName].blockingCount > 0) &&
    visitedSteps.value.includes(stepName)
  );
};

const emit = defineEmits(["stepChanged"]);
watch(activeStep, (newStep) => {
  emit("stepChanged", newStep);
});

const stepNames = computed(() => {
  return Object.keys(props.steps);
});

const flipStep = (delta) => {
  const stepTest = Object.keys(props.steps);
  const currentIndex = stepTest.indexOf(activeStep.value);
  activeStep.value = stepTest[currentIndex + delta];
};

const setStep = (stepName) => {
  activeStep.value = stepName;
};

onMounted(() => {
  flipStep(1);
});
</script>
<template>
  <nav aria-label="Progress" class="cursor-pointer">
    <ol
            role="list"
            class="flex bg-white divide-y-0 divide-gray-300 border border-gray-300"
          >
            <li
              v-for="(step, stepName, index) in steps"
              :key="step"
              @click="activeStep = stepName"
              class="justify-center ssm:justify-start relative flex flex-1"
            >
              <a
                v-if="step.valid"
                :href="step.href"
                class="group flex justify-center ssm:justify-start w-full items-center"
              >
                <span
                  class="flex items-center px-6 py-2 text-sm font-medium md:py-4"
                >
                  <span
                    class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-green-700 group-hover:bg-secondary md:h-10 md:w-10"
                  >
                    <CheckCircleIcon
                      class="h-9 w-9 text-white"
                      aria-hidden="true"
                    />
                  </span>
                  <span class="hidden ssm:block ml-4 text-sm font-medium text-gray-900">{{
                    $t("add_company.step_" + stepName)
                  }}</span>
                </span>
              </a>
              <a
                v-else-if="activeStep === stepName"
                :href="step.href"
                class="flex items-center px-6 py-2 text-sm font-medium md:py-4"
                aria-current="step"
              >
                <span
                  class="flex h-6 w-6 bg-primary flex-shrink-0 items-center justify-center rounded-full border-2 border-primary md:h-10 md:w-10"
                >
                  <span class="text-white">{{ index + 1 }}</span>
                </span>
                <span class="hidden ssm:block ml-4 text-sm font-medium text-primary">{{
                  $t("add_company.step_" + stepName)
                }}</span>
              </a>
              <a
                v-else-if="checkStepValidity(stepName)"
                :href="step.href"
                class="group flex justify-center ssm:justify-start w-full items-center"
              >
                <span
                  class="flex items-center px-6 py-2 text-sm font-medium md:py-4"
                >
                  <span
                    class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-red-700 group-hover:bg-red-800 md:h-10 md:w-10"
                  >
                    <XCircleIcon
                      class="h-9 w-9 text-white"
                      aria-hidden="true"
                    />
                  </span>
                  <span class="hidden ssm:block ml-4 text-sm font-medium text-gray-900">{{
                    $t("add_company.step_" + stepName)
                  }}</span>
                </span>
              </a>
              <a v-else :href="step.href" class="group flex items-center">
                <span
                  class="flex items-center px-6 py-2 text-sm font-medium md:py-4"
                >
                  <span
                    class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400 md:h-10 md:w-10"
                  >
                    <span class="text-gray-500 group-hover:text-gray-900">{{
                      index + 1
                    }}</span>
                  </span>
                  <span
                    class="hidden ssm:block ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900"
                    >{{ $t("add_company.step_" + stepName) }}</span
                  >
                </span>
              </a>
              <template v-if="index !== 2">
                <!-- Arrow separator for lg screens and up -->
                <div class="absolute top-0 right-0 h-full w-5 md:block">
                  <svg
                    class="h-full w-full text-gray-300"
                    viewBox="0 0 22 80"
                    fill="none"
                    preserveAspectRatio="none"
                  >
                    <path
                      d="M0 -2L20 40L0 82"
                      vector-effect="non-scaling-stroke"
                      stroke="currentcolor"
                      stroke-linejoin="round"
                    />
                  </svg>
                </div>
              </template>
              
            </li>
            
          </ol>
</nav>
    <slot name="content" />

    <div class="flex flex-row justify-center">
      <button
        @click="flipStep(-1)"
        :style="{
          visibility: activeStep !== stepNames[0] ? 'visible' : 'hidden',
        }"
        class="w-24 h-10 m-5 flex justify-center items-center rounded-lg shadow-md z-10 bg-gray-100 hover:bg-gray-200 opacity-60 hover:opacity-100"
      >
        <ChevronDoubleLeftIcon class="w-5 h-5" />
      </button>

      <button
        @click="flipStep(1)"
        :style="{
          visibility:
            activeStep !== stepNames[stepNames.length - 1]
              ? 'visible'
              : 'hidden',
        }"
        class="w-24 h-10 m-5 flex justify-center items-center rounded-lg shadow-md z-10 bg-gray-100 hover:bg-gray-200 opacity-60 hover:opacity-100"
      >
        <ChevronDoubleRightIcon class="w-5 h-5" />
      </button>
    </div>
</template>
