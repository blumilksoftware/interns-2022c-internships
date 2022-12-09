<script setup>
import { computed, watch, onMounted } from "vue";
import { ArrowSmallLeftIcon } from "@heroicons/vue/24/solid";
import useSteps from "./useSteps.js";

const { activeStep, visitedSteps } = useSteps()
const props = defineProps({
  steps: Object,
  icons: Object,
});

const checkStepValidity = (stepName) => {
  return (
    (props.steps[stepName].errorCount > 0 ||
      props.steps[stepName].blockingCount > 0) &&
    visitedSteps.value.includes(stepName)
  )
}

const emit = defineEmits(["stepChanged"])
watch(activeStep, (newStep) => {
  emit("stepChanged", newStep)
})

const stepNames = computed(() => {
  return Object.keys(props.steps)
})

const flipStep = (delta) => {
  const stepTest = Object.keys(props.steps)
  const currentIndex = stepTest.indexOf(activeStep.value)
  activeStep.value = stepTest[currentIndex + delta]
}

onMounted(() => {
  flipStep(1)
})
</script>

<template>
  <div class="flex items-center flex-col-reverse gap-3 xl:flex-row pb-10">
    <div v-if="activeStep" class="flex flex-col gap-4 flex-1">
      <h1 class="text-4xl font-semibold text-primary">
        {{ $t("add_company.descriptions." + activeStep + "_title") }}
      </h1>
      <h4 class="text-base">
        {{ $t("add_company.descriptions." + activeStep + "_text") }}
      </h4>
    </div>
    <div class="flex gap-3 flex-1 justify-end">
      <template v-for="(step, stepName, index) in steps" :key="step">
        <div
          v-if="activeStep === stepName"
          @click="activeStep = stepName"
          :class="{ 'border-emerald-700': step.valid }"
          class="max-h-20 aspect-[1/1] ssm:aspect-[1/0] p-3 ssm:w-fit border-2 border-primary rounded-xl flex items-center justify-center gap-2 cursor-default"
        >
          <component
            :is="props.icons[stepName]"
            class="h-full w-full ssm:h-12 ssm:w-12 p-2 bg-gray-200 rounded-xl"
          />
          <div class="hidden ssm:flex flex-col">
            <span class="text-xs font-semibold text-primary"
              >{{ ++index }}/{{ Object.keys(steps).length }}</span
            >
            <strong>{{ $t("add_company.step_" + stepName) }}</strong>
          </div>
        </div>

        <div
          v-else-if="step.valid"
          @click="activeStep = stepName"
          class="max-h-20 aspect-[1/1] p-3 border-2 border-emerald-700 rounded-xl flex items-center justify-center cursor-pointer"
        >
          <component
            :is="props.icons[stepName]"
            class="h-full w-full p-2 bg-gray-200 rounded-xl"
          />
        </div>

        <div
          v-else-if="checkStepValidity(stepName)"
          @click="activeStep = stepName"
          class="max-h-20 aspect-[1/1] p-3 border-2 border-red-800 rounded-xl flex items-center justify-center cursor-pointer"
        >
          <component
            :is="props.icons[stepName]"
            class="h-full w-full p-2 bg-gray-200 rounded-xl"
          />
        </div>

        <div
          v-else
          @click="activeStep = stepName"
          class="max-h-20 aspect-[1/1] p-3 border-2 border-gray-400 rounded-xl flex items-center justify-center cursor-pointer"
        >
          <component
            :is="props.icons[stepName]"
            class="h-full w-full p-2 bg-gray-200 rounded-xl"
          />
        </div>
      </template>
    </div>
  </div>
  <slot name="content" />
  <hr class="mt-12 mb-6 bg-secondary rounded h-0" />
  <div class="step-buttons flex flex-row justify-end gap-8">
    <button
      @click="flipStep(-1)"
      v-if="activeStep !== stepNames[0]"
      class="p-3 text-primary rounded-xl font-medium"
    >
      <div class="flex flex-row items-center gap-1">
        <ArrowSmallLeftIcon class="h-4" />
        <span> {{ $t("add_company.previous_step_button") }} </span>
      </div>
    </button>

    <button
      @click="flipStep(1)"
      v-if="activeStep !== stepNames[stepNames.length - 1]"
      class="p-3 text-white rounded-xl font-medium bg-primary hover:bg-secondary"
    >
      {{ $t("add_company.next_step_button") }}
    </button>
  </div>
</template>
