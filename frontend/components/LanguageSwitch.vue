<template>
  <div>
    <select
      v-model="$i18n.locale"
      class="select w-fit text-sm sm:text-xs pl-2 pr-6 py-2 text-gray-50 bg-gray-800 border-slate-900 focus:outline-none focus:ring-slate-900 focus:border-slate-800 rounded-full overflow-hidden"
    >
      <option
        class="border-slate-900"
        v-for="locale in locales"
        :key="locale.lang"
        :value="locale.lang"
      >
        {{ locale.name }}
      </option>
    </select>
  </div>
</template>

<script setup>
const locales = [
  {
    name: "Polski",
    lang: "pl",
  },
  {
    name: "English",
    lang: "en",
  },
];
</script>
