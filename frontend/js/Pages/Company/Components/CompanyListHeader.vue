<script setup>
defineProps({
  total: Number,
});
</script>

<template>
  <div
    class="px-2 py-1 pt-4 pb-5 rounded-lg border-b bg-gray-50 border-gray-200 hidden sm:block dark:bg-gray-800 dark:border-gray-900"
  >
    <h3
      class="flex justify-center text-lg leading-6 font-medium text-gray-900 dark:text-slate-200"
    >
      {{ $t("company_browser.companies_list") }}
    </h3>
    <p
      class="mt-1 flex justify-center max-w-4xl text-sm text-gray-500 dark:text-slate-200"
    >
      {{ $t("company_browser.found_companies") }} : {{ total }}
    </p>
  </div>
</template>
