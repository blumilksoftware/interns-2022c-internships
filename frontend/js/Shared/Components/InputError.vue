<script setup>
import { watch } from "vue"
import { useI18n } from "vue-i18n"
import { useToast } from "vue-toastification"

const i18n = useI18n()
const toast = useToast()
const props = defineProps(["message"])

watch(
  () => props.message,
  () => {
    if (props.message) {
      toast.error(i18n.t(props.message))
    }
  },
)
</script>

<template>
  <div dusk="error-message"
       v-if="message"
       v-show="message"
  >
    <p class="text-red-500 mb-1 text-sm font-medium">
      {{ $t(message) }}
    </p>
  </div>
</template>
