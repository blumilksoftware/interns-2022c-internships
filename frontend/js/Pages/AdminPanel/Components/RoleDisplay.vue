<script setup>
const props = defineProps({
  role: String,
});
</script>

<template>
  <span
    v-if="props.role === 'administrator'"
    class="inline-flex rounded-full bg-red-100 px-2 text-xs font-semibold leading-5 text-red-800"
    >{{ $t("admin_panel.administrator") }}</span
  >
  <span
    v-else-if="props.role === 'company'"
    class="inline-flex rounded-full bg-blue-100 px-2 text-xs font-semibold leading-5 text-blue-500"
    >{{ $t("admin_panel.company_owner") }}</span
  >
</template>
