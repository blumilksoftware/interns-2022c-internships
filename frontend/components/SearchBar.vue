<template>
  <div>
    <div class="relative flex items-center">
      <input
        type="text"
        name="search"
        id="search"
        placeholder="Szukaj po nazwie firmy"
        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md"
      />
      <div class="absolute inset-y-0 right-0 flex py-0.5 pr-1.5">
        <kbd
          class="inline-flex items-center "
        >
          <i class="fas fa-search"></i>
        </kbd>
      </div>
    </div>
    <div class="bg-slate-500"></div>
  </div>
</template>
