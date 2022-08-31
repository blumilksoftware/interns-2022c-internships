<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/js/Shared/Components/InputError.vue";
import Checkbox from "@/js/Shared/Components/Checkbox.vue";
import route from "ziggy";

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <div
    class="max-h-full flex items-center justify-center pt-16 mt-10 px-4 sm:px-6 lg:px-8"
  >
    <div class="max-w-md w-full space-y-8">
      <div>
        <img
          class="mx-auto h-17 w-auto ring-4 ring-primary rounded-full bg-primary"
          src="@/assets/images/navbar_logo.svg"
          alt="Workflow"
        />
        <h2
          class="mt-6 text-center text-3xl tracking-tight font-bold text-gray-900"
        >
          {{ $t("sign_in.header") }}
        </h2>
      </div>

      <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ $t(status) }}
      </div>

      <form class="mt-8 space-y-6" @submit.prevent="submit">
        <InputError class="mt-2" :message="form.errors.email" />
        <InputError class="mt-2" :message="form.errors.password" />

        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <input
              id="email-address"
              name="email"
              type="email"
              autocomplete="email"
              v-model="form.email"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
              :placeholder="$t('common_labels.email')"
            />
          </div>
          <div>
            <input
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              v-model="form.password"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
              :placeholder="$t('common_labels.password')"
            />
          </div>
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <Checkbox
              id="remember-me"
              name="remember-me"
              v-model:checked="form.remember"
              type="checkbox"
              class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
            />
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">
              {{ $t("sign_in.remember") }}
            </label>
          </div>
          <div class="text-sm">
            <InertiaLink
              :href="route('password.request')"
              class="font-medium text-primary hover:text-primary"
            >
              {{ $t("sign_in.forgot_password") }}
            </InertiaLink>
          </div>
        </div>
        <div>
          <button
            type="submit"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
          >
            {{ $t("buttons.sign_in_button") }}
          </button>
        </div>
      </form>
      <InertiaLink :href="route('register')">
        <button
          type="submit"
          class="group mt-2 relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
        >
          {{ $t("buttons.registration_button") }}
        </button>
      </InertiaLink>
    </div>
  </div>
</template>
