<script setup>
import { computed, ref } from "vue";
import { PhotoIcon, XMarkIcon } from "@heroicons/vue/24/solid";
import { useToast } from "vue-toastification";
import { useI18n } from "vue-i18n";

const toast = useToast();
const i18n = useI18n();

const props = defineProps({
  modelValue: File,
  id: String,
});

const maxFileSize = 3 * 1024 * 1024;
const acceptedFileTypes = ["image/jpeg", "image/png", "image/gif"];

const emit = defineEmits(["update:modelValue"]);
const value = computed({
  get: () => props.modelValue,
  set: (value) => {
    if (value === null) {
      emit("update:modelValue", null);
    } else if (!acceptedFileTypes.includes(value.type)) {
      toast.error(i18n.t("validation.image"));
    } else if (value.size > maxFileSize) {
      toast.error(i18n.t("validation.max.file"));
    } else {
      emit("update:modelValue", value);
    }
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
      dragging ? 'bg-gray-100' : 'bg-transparent',
      'relative w-full flex justify-center transition p-3',
    ]"
    @dragover.prevent="dragging = true"
    @dragleave="dragging = false"
    @drop.prevent="drop"
  >
    <label
      v-show="!imagePreviewUrl"
      :for="id"
      class="block cursor-pointer text-center space-y-1 my-4 group text-sm rounded-md font-medium text-primary"
    >
      <PhotoIcon
        :class="[
          dragging ? 'text-primary' : 'text-gray-400 group-hover:text-primary',
          'mx-auto h-24 w-24',
        ]"
      />
      <span>{{ $t("image_uploader.upload_file") }}</span>
      <span class="block text-xs text-gray-500">{{
        $t("image_uploader.allowed_extensions")
      }}</span>
      <input
        :id="id"
        ref="file"
        type="file"
        accept=".png,.jpg,.gif"
        class="hidden"
        @click="file.value = null"
        @change="onChange"
      />
    </label>
    <div v-show="imagePreviewUrl" class="flex items-center">
      <img
        :src="imagePreviewUrl"
        class="max-h-full max-w-full"
        :alt="$t('add_company.logo')"
      />
      <button
        type="button"
        :title="$t('add_company.logo_delete')"
        class="absolute top-1 right-1 p-1 rounded-md hover:bg-gray-100"
        @click="value = null"
      >
        <XMarkIcon class="h-6 w-6 text-primary bg-white" />
      </button>
    </div>
  </div>
</template>
