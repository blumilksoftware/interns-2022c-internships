<script setup>
import { computed, ref } from "vue";
import { PhotographIcon, XIcon } from "@heroicons/vue/solid";

const props = defineProps({
  modelValue: File,
  id: String,
});

const emit = defineEmits(["update:modelValue"]);
const value = computed({
  get: () => props.modelValue,
  set: (value) => {
    emit("update:modelValue", value);
    console.log(value);
  },
});

const imagePreviewUrl = computed(() =>
  value.value ? URL.createObjectURL(value.value) : null
);
const file = ref(null);
const dragging = ref(false);

function onChange() {
  value.value = file.value.files[0];
}

function drop(event) {
  file.value.files = event.dataTransfer.files;
  onChange();
  dragging.value = false;
}
</script>

<template>
  <div
    :class="[
      dragging ? 'bg-gray-100' : 'bg-white',
      'relative w-full flex justify-center transition transition-colors p-6 border border-gray-300 rounded-md',
    ]"
    @dragover.prevent="dragging = true"
    @dragleave="dragging = false"
    @drop.prevent="drop"
  >
    <label
      v-show="!imagePreviewUrl"
      :for="id"
      class="block cursor-pointer text-center space-y-1 my-4 group text-sm rounded-md font-medium text-teal-600 hover:text-teal-700"
    >
      <PhotographIcon
        :class="[
          dragging
            ? 'text-teal-500'
            : 'text-gray-400 group-hover:text-teal-500',
          'mx-auto h-12 w-12',
        ]"
      />
      <span>{{ $t("image_uploader.upload_file") }}</span>
      <span class="block text-xs text-gray-500">{{ $t("image_uploader.allowed_extensions") }}</span>
      <input
        :id="id"
        ref="file"
        type="file"
        accept=".png,.jpg,.gif"
        class="hidden"
        @change="onChange"
      />
    </label>
    <div v-show="imagePreviewUrl">
      <img :src="imagePreviewUrl" class="max-h-64" />
      <button
        type="button"
        title="Usuń"
        class="absolute top-1 right-1 p-1 rounded-md hover:bg-gray-100"
        @click="value = null"
      >
        <XIcon class="h-6 w-6 text-gray-600" />
      </button>
    </div>
  </div>
</template>
