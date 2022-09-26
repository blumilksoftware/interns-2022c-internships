<script setup>
import { watch } from "vue";
import { useI18n } from "vue-i18n";
import { useToast } from "vue-toastification";

const i18n = useI18n();
const toast = useToast();
const props = defineProps(["message"]);

watch(
  () => props.message,
  () => {
    if (props.message) {
      toast.error(i18n.t(props.message));
    }
  }
);
</script>

<template>
  <div v-if="message" v-show="message">
    <p class="text-sm mt-2 text-red-600">
      {{ $t(message) }}
    </p>
  </div>
</template>
