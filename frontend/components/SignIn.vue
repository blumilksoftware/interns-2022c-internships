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
          {{ $t("SignIn.Header") }}
        </h2>
      </div>
      <form class="mt-8 space-y-6" action="#" method="POST">
        <input type="hidden" name="remember" value="true" />
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <input
              id="email-address"
              name="email"
              type="email"
              autocomplete="email"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
              :placeholder="$t('CommonLabels.Email')"
            />
          </div>
          <div>
            <input
              id="password"
              name="password"
              type="password"
              autocomplete="current-password"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
              :placeholder="$t('CommonLabels.Password')"
            />
          </div>
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input
              id="remember-me"
              name="remember-me"
              type="checkbox"
              class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
            />
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">
              {{ $t("SignIn.Remember") }}
            </label>
          </div>
          <div class="text-sm">
            <a
              href="#/forgotpassword"
              class="font-medium text-primary hover:text-primary"
            >
              {{ $t("SignIn.ForgotPassword") }}
            </a>
          </div>
        </div>
        <div>
          <button
            type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
          >
            {{ $t("Buttons.SignInButton") }}
          </button>
        </div>
      </form>
      <a href="/#/registration">
        <button
          type="submit"
          class="group mt-2 relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
        >
          {{ $t("Buttons.RegistrationButton") }}
        </button>
      </a>
    </div>
  </div>
</template>
