<script setup>
const props = defineProps({
  role: String,
});
</script>

<template>
  <button
    v-if="props.role !== 'administrator'"
    type="button"
    class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
  >
    {{ $t("buttons.remove_button") }}
  </button>
  <div
    v-else
    class="inline-flex items-center disabled rounded-md border border-transparent bg-slate-300 px-4 py-2 text-sm font-medium text-white shadow-sm cursor-not-allowed"
  >
    {{ $t("buttons.remove_button") }}
  </div>
</template>
