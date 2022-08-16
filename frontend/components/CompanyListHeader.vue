<template>
  <div
    class="px-2 py-1 pt-4 pb-5 rounded-lg border-b bg-gray-50 border-gray-200"
  >
    <h3 class="text-lg leading-6 font-medium text-gray-900">Lista firm</h3>
    <p class="mt-1 max-w-4xl text-sm text-gray-500">Znaleziono: 0</p>
  </div>
  <div class="w-full">
    <label for="search" class="sr-only">Wyszukaj</label>
    <div class="relative">
      <div
        class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center"
      >
        <SearchIcon class="h-5 w-5 text-gray-500" aria-hidden="true" />
      </div>
      <input
        id="search"
        name="search"
        class="block w-full bg-white border border-gray-300 rounded-md py-2 pl-10 pr-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        placeholder="Wyszukaj"
        type="search"
      />
    </div>
  </div>
</template>

<script setup>
import { SearchIcon } from "@heroicons/vue/solid";
</script>
