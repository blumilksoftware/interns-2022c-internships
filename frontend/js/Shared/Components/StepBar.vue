<script setup>
import { computed, watch, onMounted } from "vue";
import {
  MapPinIcon,
  BuildingOffice2Icon,
  PencilSquareIcon,
  ArrowSmallLeftIcon,
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

onMounted(() => {
  flipStep(1);
});
</script>
<template>
  <div class="flex items-center flex-col-reverse gap-3 xl:flex-row pb-10">
    <div class="flex flex-col gap-4 flex-1">
      <h1 class="text-4xl font-semibold text-primary">
        {{ $t("add_company.descriptions." + activeStep + "_title") }}
      </h1>
      <h4 class="text-md">
        {{ $t("add_company.descriptions." + activeStep + "_description") }}
      </h4>
    </div>
    <div class="flex gap-3 flex-1 justify-end">
      <template v-for="(step, stepName, index) in steps" :key="step">
        <div
          v-if="activeStep === stepName"
          @click="activeStep = stepName"
          :class="{ 'border-emerald-700': step.valid }"
          class="h-20 w-fit px-3 border-2 border-primary rounded-xl flex items-center justify-center gap-2 cursor-default"
        >
          <BuildingOffice2Icon class="h-12 w-12 p-2 bg-gray-200 rounded-xl" />
          <div class="flex flex-col">
            <span class="text-xs font-semibold text-primary"
              >{{ ++index }}/{{ Object.keys(steps).length }}</span
            >
            <strong>{{ $t("add_company.step_" + stepName) }}</strong>
          </div>
        </div>

        <div
          v-else-if="step.valid"
          @click="activeStep = stepName"
          class="h-20 w-20 border-2 border-emerald-700 rounded-xl flex items-center justify-center cursor-pointer"
        >
          <MapPinIcon class="h-12 w-12 p-2 bg-gray-200 rounded-xl" />
        </div>

        <div
          v-else-if="checkStepValidity(stepName)"
          @click="activeStep = stepName"
          class="h-20 w-20 border-2 border-red-800 rounded-xl flex items-center justify-center cursor-pointer"
        >
          <MapPinIcon class="h-12 w-12 p-2 bg-gray-200 rounded-xl" />
        </div>

        <div
          v-else
          @click="activeStep = stepName"
          class="h-20 w-20 border-2 border-gray-400 rounded-xl flex items-center justify-center cursor-pointer"
        >
          <MapPinIcon class="h-12 w-12 p-2 bg-gray-200 rounded-xl" />
        </div>
      </template>
    </div>
  </div>
  <slot name="content" />

  <div class="flex flex-row justify-end gap-8">
    <button
      @click="flipStep(-1)"
      :style="{
        visibility: activeStep !== stepNames[0] ? 'visible' : 'hidden',
      }"
      class="p-3 text-primary rounded-xl font-medium"
    >
      <div class="flex flex-row items-center gap-1">
        <ArrowSmallLeftIcon class="h-4" />
        <span>Poprzedni krok</span>
      </div>
    </button>

    <button
      @click="flipStep(1)"
      :style="{
        visibility:
          activeStep !== stepNames[stepNames.length - 1] ? 'visible' : 'hidden',
      }"
      class="p-3 text-white rounded-xl font-medium bg-primary hover:bg-secondary"
    >
      Następny krok
    </button>
  </div>
</template>
