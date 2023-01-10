<script setup>
import { computed } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import route from "ziggy";

const props = defineProps({
  status: String,
});

const form = useForm();

const submit = () => {
  form.post(route("verification.send"));
};

const verificationLinkSent = computed(
  () => props.status === "verification-link-sent"
);
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
          class="mt-6 text-center text-lg tracking-tight font-bold text-gray-900"
        >
          {{ $t("verify_email.header") }}
        </h2>
      </div>
      <div
        class="mb-4 font-medium text-sm text-green-600"
        v-if="verificationLinkSent"
      >
        {{ $t("verify_email.email_sent") }}
      </div>

      <form @submit.prevent="submit">
        <div>
          <button
            type="submit"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
          >
            {{ $t("verify_email.resend_email_button") }}
          </button>
          <InertiaLink
            :href="route('logout')"
            as="button"
            class="group mt-2 relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
          >
            {{ $t("buttons.logout_button") }}
          </InertiaLink>
        </div>
      </form>
    </div>
  </div>
</template>
