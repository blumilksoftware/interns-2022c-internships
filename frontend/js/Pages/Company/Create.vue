<script setup>
import Treeselect from "vue3-treeselect";
import "vue3-treeselect/dist/vue3-treeselect.css";

defineProps({
  departments: Object,
});
</script>

<template>
  <div class="flex items-center justify-center p-5">
    <div class="mx-auto w-full max-w-5xl p-6 bg-white">
      <form method="POST">
        <div class="mb-2">
          <label
            for="name"
            class="mb-3 block text-base font-medium text-secondary"
          >
            {{ $t("AddCompany.CompanyName") }}
          </label>
          <input
            required
            type="text"
            name="name"
            id="name"
            class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium text-slate-500 outline-none focus:border-secondary focus:shadow-md"
          />
        </div>
        <div class="mb-2">
          <label
            for="email"
            class="mb-3 block text-base font-medium text-secondary"
          >
            {{ $t("CommonLabels.Email") }}
          </label>
          <input
            required
            type="email"
            name="email"
            id="email"
            class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium text-slate-500 outline-none focus:border-secondary focus:shadow-md"
          />
        </div>
        <div class="mb-2">
          <label
            for="weburl"
            class="mb-3 block text-base font-medium text-secondary"
          >
            Webpage URL
          </label>
          <input
            required
            type="weburl"
            name="weburl"
            id="weburl"
            class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium text-slate-500 outline-none focus:border-secondary focus:shadow-md"
          />
        </div>
        <div class="flex flex-initial">
          <label for="photo" class="block text-base font-medium text-secondary">
            Logo
          </label>
          <label
            for="photo"
            class="px-2 m-auto flex-none block text-base font-medium text-secondary"
          >
            Choose targeted specializations
          </label>
        </div>

        <div class="flex flex-initial">
          <div class="flex m-auto">
            <span class="h-20 w-20 rounded-lg overflow-hidden bg-slate-300">
              <svg
                class="h-full min-w-full w-full text-slate-500"
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
              class="ml-5 bg-white py-2 px-3 border border-slate-500 my-auto rounded-md shadow-sm text-sm leading-4 font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary"
            >
              {{ $t("buttons.change_button") }}
            </button>
          </div>

          <Treeselect
            class="m-auto w-1/2"
            :options="departments.data"
            :multiple="true"
            :disable-branch-nodes="true"
            :placeholder="$t('TreeSelects.TreeSelectSpecialization')"
            search-nested
            v-model="specializationSelect"
          />
        </div>
        <div class="sm:items-start pt-2">
          <label
            for="description"
            class="block text-base font-medium text-secondary"
          >
            {{ $t("AddCompany.Description") }}
          </label>
          <div class="mt-1 sm:mt-0 sm:col-span-2">
            <textarea
              required
              id="description"
              name="description"
              rows="3"
              class="shadow-sm block w-full text-base font-medium text-slate-500 focus:ring-secondary focus:border-secondary sm:text-sm border border-slate-300 rounded-md"
            />
            <p class="mt-2 text-sm text-slate-500">
              {{ $t("AddCompany.DescriptionInfo") }}
            </p>
          </div>
        </div>

        <div class="mb-2 pt-3">
          <label
            class="mb-2 block text-base font-semibold text-secondary sm:text-xl"
          >
            Address Details
          </label>
          <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
              <div class="mb-2">
                <div>
                  <select
                    required
                    id="City"
                    name="City"
                    class="mt-1 block w-full px-3 rounded-md border-slate-300 py-2 pl-3 pr-10 text-base font-medium text-slate-500 focus:border-secondary focus:outline-none focus:ring-secondary sm:text-sm"
                  >
                    <option selected="disable">City</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
              <div class="mb-2">
                <div>
                  <select
                    id="Voivodeship"
                    required
                    name="Voivodeship"
                    class="mt-1 px-3 block w-full rounded-md border-slate-300 py-2 pl-3 pr-10 text-base font-medium text-slate-500 focus:border-secondary focus:outline-none focus:ring-secondary sm:text-sm"
                  >
                    <option selected="disable">Voivodeship</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
              <div class="mb-2">
                <input
                  required
                  type="text"
                  name="Street"
                  id="Street"
                  placeholder="Street"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium text-slate-500 outline-none focus:border-secondary focus:shadow-md"
                />
              </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
              <div class="mb-2">
                <input
                  required
                  type="text"
                  name="Building"
                  id="Building"
                  placeholder="Building"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium text-slate-500 outline-none focus:border-secondary focus:shadow-md"
                />
              </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
              <div class="mb-2">
                <input
                  required
                  type="text"
                  name="PostCode"
                  id="PostCode"
                  placeholder="Post Code"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium text-slate-500 outline-none focus:border-secondary focus:shadow-md"
                />
              </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
              <div class="mb-2">
                <input
                  type="text"
                  name="PhoneNumber"
                  id="PhoneNumber"
                  placeholder="Phone number"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium text-slate-500 outline-none focus:border-secondary focus:shadow-md"
                />
              </div>
            </div>
          </div>
        </div>

        <div>
          <button
            class="hover:shadow-form w-full rounded-md bg-secondary py-3 px-8 text-center text-base font-semibold text-white outline-none"
          >
            Request adding company
          </button>
          <p
            class="flex justify-center mt-1 text-center text-sm text-slate-500"
          >
            {{ $t("AddCompany.HeaderInfo") }}
          </p>
        </div>
      </form>
    </div>
  </div>
</template>
