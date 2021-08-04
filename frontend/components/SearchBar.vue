<template>
  <div>
    <div class="mt-1 relative flex items-center">
      <input
        type="text"
        name="search"
        id="search"
        placeholder="Szukaj po nazwie firmy"
        class="
          shadow-sm
          focus:ring-indigo-500 focus:border-indigo-500
          block
          w-full
          pr-12
          sm:text-sm
          border-gray-300
          rounded-md
        "
      />
      <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
        <kbd
          class="
            inline-flex
            items-center
            border border-gray-200
            rounded
            px-2
            text-sm
            font-sans font-medium
            text-gray-400
          "
        >
          <i class="fas fa-search"></i>
        </kbd>
      </div>
    </div>
  </div>
</template>
