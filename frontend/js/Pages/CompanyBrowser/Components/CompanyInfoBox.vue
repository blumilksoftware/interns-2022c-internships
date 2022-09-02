<script setup>
defineProps({
  company: Object,
});

const emit = defineEmits(["close"]);
function onClose() {
  emit("close");
}
</script>

<template>
  <div
    class="shadow ring-1 ring-black ring-opacity-5 md:rounded-lg overflow-x-hidden overflow-y-scroll"
  >
    <div class="h-full rounded-lg bg-white shadow-lg p-2">
      <div class="flex justify-end mt-8">
        <button
          @click="onClose"
          class="py-2 px-4 bg-white border border-gray-200 text-gray-600 rounded hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50"
        >
          Close
        </button>
      </div>

      <div class="flex justify-center">
        <img
          class="h-20 w-auto sm:h-40 sm:w-40 rounded-lg border-2"
          :src="'/storage/images/' + company.logo"
          alt=""
        />
      </div>

      <div class="text-center mt-2 px-10">
        <h1 class="text-purple-900 font-bold text-2xl">{{ company.name }}</h1>
        <p class="text-gray-500 mt-3">
          {{ company.location.fullName }}
        </p>

        <div class="justify-content-between py-8 border-b border-indigo-50">
          {{ company.description }}
        </div>

        <div class="mt-1">
          <ul class="inline-grid justify-center mt-2">
            <template v-for="specialization in company.specializations">
              <span
                class="bg-blue-100 text-blue-800 text-xs font-semibold mt-2 mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800"
              >
                {{ specialization.label }}
              </span>
            </template>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
