<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/js/Shared/Components/InputError.vue";

defineProps({
  auth: Object,
});

const form = useForm({
  name: null,
  description: null,
  address: {
    street: null,
    city: null,
    postal_code: null,
    voivodeship: null,
    country: null,
    coordinates: {
      latitude: "0",
      longitude: "0",
    },
  },
  contact_details: {
    email: null,
    website_url: "1",
    phone_number: "1",
  },
});

const submit = () => {
  form.post(route("company-store"), {
    onFinish: () => form.reset(),
  });
};
</script>

<template>
  <form
    class="space-y-8 divide-y divide-gray-200 mx-auto mt-3"
    @submit.prevent="submit"
  >
    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
      <div>
        <div>
          <h3
            class="flex justify-center text-lg leading-6 font-medium text-gray-900"
          >
            {{ $t("add_company.header") }}
          </h3>
          <p class="flex justify-center mt-1 max-w-2xl text-sm text-gray-500">
            {{ $t("add_company.header_info") }}
          </p>
        </div>
        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
          <div
            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
          >
            <label
              for="username"
              class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
            >
              {{ $t("add_company.company_name") }}
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <div class="max-w-lg flex rounded-md shadow-sm">
                <input
                  required
                  type="text"
                  v-model="form.name"
                  name="name"
                  id="name"
                  autocomplete="username"
                  class="flex-1 block w-full focus:ring-primary focus:border-primary min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
                />
                <InputError class="mt-2" :message="form.errors.name" />
              </div>
            </div>
          </div>
          <div
            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
          >
            <label
              for="description"
              class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
            >
              {{ $t("add_company.description") }}
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <textarea
                id="description"
                name="description"
                v-model="form.description"
                rows="3"
                class="max-w-lg shadow-sm block w-full focus:ring-primary focus:border-primary sm:text-sm border border-gray-300 rounded-md"
              />
              <InputError class="mt-2" :message="form.errors.description" />
              <p class="mt-2 text-sm text-gray-500">
                {{ $t("add_company.description_info") }}
              </p>
            </div>
          </div>

          <div
            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-5"
          >
            <label for="photo" class="block text-sm font-medium text-gray-700">
              Logo
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <div class="flex justify-center items-center">
                <span class="h-14 w-14 rounded-lg overflow-hidden bg-gray-100">
                  <svg
                    class="h-full w-full text-gray-300"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"
                    />
                  </svg>
                </span>
                <button
                  type="button"
                  class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                >
                  {{ $t("buttons.change_button") }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
      >
        <label
          for="email"
          class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
        >
          {{ $t("common_labels.email") }}
        </label>
        <div class="mt-1 sm:mt-0 sm:col-span-2">
          <div class="max-w-lg flex rounded-md shadow-sm">
            <input
              required
              id="description"
              name="description"
              v-model="form.contact_details.email"
              rows="3"
              class="shadow-sm block w-full text-base font-medium text-slate-500 focus:ring-secondary focus:border-secondary sm:text-sm border border-slate-300 rounded-md"
            />
            <p class="mt-2 text-sm text-slate-500">
              {{ $t("AddCompany.DescriptionInfo") }}
            </p>
            <InputError class="mt-2" :message="form.errors.contact_details" />
          </div>
        </div>

        <div class="mb-2 pt-3">
          <label
            class="mb-2 block text-base font-semibold text-secondary sm:text-xl"
          >
            Address Details
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <select
              id="country"
              name="country"
              v-model="form.address.country"
              autocomplete="country-name"
              class="flex-1 block w-full focus:ring-primary focus:border-primary min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
            >
              <option>Poland</option>
              <option>Other country</option>
              <option>Other country</option>
              <option>Other country</option>
              <option>Other country</option>
            </select>
          </div>
        </div>
        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="street-address"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("add_company.street_address") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input
              required
              type="text"
              name="street-address"
              id="street-address"
              v-model="form.address.street"
              autocomplete="street-address"
              class="flex-1 block w-full focus:ring-primary focus:border-primary min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
            />
          </div>
        </div>
        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="city"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("add_company.city") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input
              required
              type="text"
              name="city"
              id="city"
              v-model="form.address.city"
              autocomplete="address-level2"
              class="flex-1 block w-full focus:ring-primary focus:border-primary min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
            />
          </div>
        </div>
        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="region"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("add_company.voivodeship") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input
              required
              type="text"
              name="region"
              id="region"
              v-model="form.address.voivodeship"
              autocomplete="address-level1"
              class="flex-1 block w-full focus:ring-primary focus:border-primary min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
            />
          </div>
        </div>
        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="postal-code"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("add_company.postal_code") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input
              required
              type="text"
              name="postal-code"
              id="postal-code"
              v-model="form.address.postal_code"
              autocomplete="postal-code"
              class="flex-1 block w-full focus:ring-primary focus:border-primary min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
            />
            <InputError class="mt-2" :message="form.errors.address" />
          </div>
        </div>
      </div>
    </div>
    <div class="pt-5">
      <div class="flex justify-end">
        <button
          type="button"
          class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
        >
          {{ $t("buttons.cancel_button") }}
        </button>
        <button
          type="submit"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
        >
          {{ $t("buttons.request_button") }}
        </button>
      </div>
    </div>
  </form>
</template>
