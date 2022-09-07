<script setup>
const props = defineProps({
  status: String,
});
</script>

<template>
  <button
    v-if="props.status !== 'verified'"
    type="button"
    class="inline-flex items-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
  >
    Approve
  </button>
  <div
    v-else
    class="inline-flex items-center rounded-md border border-transparent bg-slate-300 px-4 py-2 text-sm font-medium text-white shadow-sm"
  >
    Approve
  </div>
</template>
