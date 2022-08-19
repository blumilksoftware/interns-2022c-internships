<template>
  <div>
    <select
      v-model="$i18n.locale"
      class="appearance-none w-fit text-xs pl-3 pr-10 py-2 text-slate-100 bg-secondary border-slate-900 focus:outline-none focus:ring-slate-500 focus:border-slate-500 rounded-full"
    >
      <option v-for="locale in locales" :key="locale.lang" :value="locale.lang">
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
    flag: "https://flagicons.lipis.dev/flags/4x3/gb.svg",
  },
];
</script>
