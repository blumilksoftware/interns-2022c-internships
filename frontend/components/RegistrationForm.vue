<template>
  <form
    class="space-y-8 divide-y divide-gray-200 mx-auto mt-11"
    action="#"
    method="POST"
  >
    <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
      <div>
        <h3
          class="text-lg leading-6 font-medium text-gray-900 flex justify-center"
        >
          {{ $t("Registration.Header") }}
        </h3>
      </div>
      <div class="space-y-6 sm:space-y-5">
        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="first-name"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("Registration.FirstName") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input
              required
              type="text"
              name="first-name"
              id="first-name"
              autocomplete="given-name"
              class="max-w-lg block w-full shadow-sm focus:ring-primary focus:border-primary sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
            />
          </div>
        </div>

        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="last-name"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("Registration.LastName") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input
              required
              type="text"
              name="last-name"
              id="last-name"
              autocomplete="family-name"
              class="max-w-lg block w-full shadow-sm focus:ring-primary focus:border-primary sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
            />
          </div>
        </div>

        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="email"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("CommonLabels.Email") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input
              required
              id="email"
              name="email"
              type="email"
              autocomplete="email"
              class="block max-w-lg w-full shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md"
            />
          </div>
        </div>

        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="password"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("CommonLabels.Password") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input
              required
              id="password"
              name="password"
              type="password"
              autocomplete="password"
              class="block max-w-lg w-full shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md"
            />
          </div>
        </div>

        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="country"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("CommonLabels.Country") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <select
              id="country"
              name="country"
              autocomplete="country-name"
              class="max-w-lg block focus:ring-primary focus:border-primary w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
            >
              <option>Poland</option>
              <option>Canada</option>
              <option>Mexico</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="pt-5">
      <div class="flex justify-end">
        <a href="/#">
          <button
            type="button"
            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
          >
            {{ $t("Buttons.CancelButton") }}
          </button>
        </a>
        <button
          type="submit"
          class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
        >
          {{ $t("Buttons.RegistrationButton") }}
        </button>
      </div>
    </div>
  </form>
</template>
