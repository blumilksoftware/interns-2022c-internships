<script setup>
import locales from "@/assets/lang/index.js";
</script>

<template>
  <div>
    <select
      v-model="$i18n.locale"
      @change="$formkit.setLocale($i18n.locale)"
      class="select w-fit text-sm sm:text-xs pl-2 pr-6 py-2 text-gray-50 bg-primary focus:bg-blue-900 hover:bg-blue-900 rounded-full overflow-hidden"
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
