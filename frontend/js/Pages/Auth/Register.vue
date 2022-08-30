<template>
  <form
    @submit.prevent="submit"
    class="space-y-8 divide-y divide-gray-200 mx-auto mt-11"
  >
    <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
      <div>
        <h3
          class="text-lg leading-6 font-medium text-gray-900 flex justify-center"
        >
          {{ $t("registration.header") }}
        </h3>
      </div>
      <div class="space-y-6 sm:space-y-5">
        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="first_name"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("registration.first_name") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input
              required
              type="text"
              name="first_name"
              id="first_name"
              v-model="form.first_name"
              autocomplete="given-name"
              class="block max-w-lg w-80 shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md"
            />
            <InputError class="mt-2" :message="form.errors.first_name" />
          </div>
        </div>
        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="last_name"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("registration.last_name") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input
              required
              type="text"
              name="last_name"
              id="last_name"
              v-model="form.last_name"
              autocomplete="family-name"
              class="block max-w-lg w-80 shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md"
            />
            <InputError class="mt-2" :message="form.errors.last_name" />
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
            <input
              required
              id="email"
              name="email"
              type="email"
              v-model="form.email"
              autocomplete="email"
              class="block max-w-lg w-80 shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md"
            />
            <InputError class="mt-2" :message="form.errors.email" />
          </div>
        </div>
        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="password"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("common_labels.password") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input
              required
              id="password"
              name="password"
              type="password"
              v-model="form.password"
              autocomplete="password"
              class="block max-w-lg w-80 shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md"
            />
            <InputError class="mt-2" :message="form.errors.password" />
          </div>
        </div>
        <div
          class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
        >
          <label
            for="password_confirmation"
            class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
          >
            {{ $t("common_labels.password_confirm") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <input
              required
              id="password_confirmation"
              name="password_confirmation"
              type="password"
              v-model="form.password_confirmation"
              autocomplete="password"
              class="block max-w-lg w-80 shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md"
            />
            <InputError
              class="mt-2"
              :message="form.errors.password_confirmation"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="pt-5">
      <div class="flex justify-end">
        <InertiaLink :href="route('login')">
          <button
            type="button"
            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
          >
            {{ $t("buttons.cancel_button") }}
          </button>
        </InertiaLink>
        <button
          type="submit"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
        >
          {{ $t("buttons.registration_button") }}
        </button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/js/Shared/Components/InputError.vue";
import route from "ziggy";

const form = useForm({
  first_name: "",
  last_name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: false,
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>
