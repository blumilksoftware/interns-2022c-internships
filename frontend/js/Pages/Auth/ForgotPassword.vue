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
          {{ $t("ForgotPassword.Header") }}
        </h2>
      </div>

      <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ $t(status) }}
      </div>
      <InputError class="mt-2" :message="form.errors.email" />

      <form class="mt-8 space-y-6" @submit.prevent="submit">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="email-address" class="sr-only">{{
                $t("CommonLabels.Email")
              }}</label>
            <input
                id="email-address"
                name="email"
                type="email"
                v-model="form.email"
                autocomplete="email"
                required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                :placeholder="$t('CommonLabels.Email')"
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
            {{ $t("ForgotPassword.ResetButton") }}
          </button>
        </div>
      </form>
      <InertiaLink
          :href="route('login')"
      >
        <button
            type="submit"
            class="group mt-2 relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
        >
          {{ $t("Buttons.SignInButton") }}
        </button>
      </InertiaLink>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/js/Shared/Components/InputError.vue';

defineProps({
  status: String,
  errors: String,
});

const form = useForm({
  email: '',
});

const submit = () => {
  form.post(route('password.email'));
};
</script>