<template>
  <div
    class="bg-gray-50 min-h-full px-4 py-16 sm:px-5 sm:py-20 md:grid md:place-items-center"
  >
    <div class="max-w-max mx-auto">
      <main class="sm:flex">
        <p
          class="text-4xl tracking-tight font-bold text-primary sm:text-5xl sm:tracking-tight"
        >
          404
        </p>
        <div class="sm:ml-6">
          <div class="sm:border-l sm:border-gray-200 sm:pl-6">
            <h1
              class="text-4xl font-bold text-gray-900 tracking-tight sm:text-5xl sm:tracking-tight"
            >
              {{ $t("PageNotFound.Header") }}
            </h1>
            <p class="mt-1 text-base text-gray-500">
              {{ $t("PageNotFound.Description") }}
            </p>
          </div>
          <div
            class="mt-10 flex space-x-3 sm:border-l sm:border-transparent sm:pl-6"
          >
            <a
              href="#"
              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
            >
              {{ $t("Buttons.GoHomeButton") }}
            </a>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>
