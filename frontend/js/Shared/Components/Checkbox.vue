<script setup>
import { computed } from "vue"

const emit = defineEmits(["update:checked"])

const props = defineProps({
  checked: {
    type: [Array, Boolean],
    default: false,
  },
  value: {
    default: null,
  },
})

const proxyChecked = computed({
  get() {
    return props.checked
  },

  set(val) {
    emit("update:checked", val)
  },
})
</script>

<template>
  <input
    v-model="proxyChecked"
    type="checkbox"
    :value="value"
    class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
  >
</template>
