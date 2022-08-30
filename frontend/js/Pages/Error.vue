<template>
  <div
    class="max-h-full px-4 py-16 sm:px-5 sm:py-20 md:grid my-auto md:place-items-center"
  >
    <div class="max-w-max mx-auto">
      <main class="sm:flex">
        <p
          class="text-4xl tracking-tight font-bold text-primary sm:text-5xl sm:tracking-tight"
        >
          {{ $t("error.header") }} {{ props.status }}
        </p>
        <div class="sm:ml-6">
          <div class="sm:border-l sm:border-gray-300 sm:pl-6">
            <h1
              class="text-4xl font-bold text-gray-900 tracking-tight sm:text-5xl sm:tracking-tight"
            >
              {{ $t("error.name_" + props.status) }}
            </h1>
            <p class="mt-1 text-base text-gray-500">
              {{ $t("error.description_" + props.status) }}
            </p>
          </div>
          <div
            class="mt-10 flex space-x-3 sm:border-l sm:border-transparent sm:pl-6"
          >
            <InertiaLink
              href="/"
              className="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
            >
              {{ $t("buttons.go_home_button") }}
            </InertiaLink>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  status: Number,
});
</script>
