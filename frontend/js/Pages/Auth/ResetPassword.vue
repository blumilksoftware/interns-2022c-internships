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
            class="mt-6 text-center text-xl tracking-tight font-bold text-gray-900"
        >
          {{ $t("forgot_password.reset_confirm_header") }}
        </h2>
      </div>

      <form class="mt-8 space-y-6" @submit.prevent="submit">
        <InputError class="mt-2" :message="form.errors.email" />
        <InputError class="mt-2" :message="form.errors.password" />
        <InputError class="mt-2" :message="form.errors.password_confirmation" />
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="email-address" class="sr-only">{{
                $t("common_labels.email")
              }}</label>
            <input
                id="email-address"
                name="email"
                type="email"
                v-model="form.email"
                autocomplete="email"
                required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                :placeholder="$t('common_labels.email')"
            />
          </div>

          <div>
            <label for="password" class="sr-only">{{
                $t("common_labels.password")
              }}</label>
            <input
                id="password"
                name="password"
                type="password"
                v-model="form.password"
                autocomplete="new_password"
                required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                :placeholder="$t('common_labels.password')"
            />
          </div>

          <div>
            <label for="password_confirmation" class="sr-only">{{
                $t("common_labels.password_confirm")
              }}</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                v-model="form.password_confirmation"
                autocomplete="new_password"
                required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                :placeholder="$t('common_labels.password_confirm')"
            />
          </div>

        </div>
        <div>
          <button
              type="submit"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
          >
            {{ $t("forgot_password.reset_confirm_button") }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/js/Shared/Components/InputError.vue";
import route from "ziggy";

const props = defineProps({
  email: String,
  token: String,
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('password.update'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>
