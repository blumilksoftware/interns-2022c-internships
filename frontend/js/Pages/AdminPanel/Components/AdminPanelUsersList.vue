<script setup>
import Button from "@/js/Shared/Components/Button.vue";
import RoleDisplay from "./RoleDisplay.vue";
import MoreInfo from "./MoreInfoButton.vue";
import { SearchIcon } from "@heroicons/vue/solid";
import { TrashIcon } from "@heroicons/vue/outline";
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
const props = defineProps({
  users: Object,
  filter: String,
});
let UsersSearch = ref(props.filter.UsersSearch);
const emit = defineEmits(["selected"]);
watch([UsersSearch], () => {
  emit("selected", UsersSearch);
});
const form = useForm();
function destroy(id) {
  if (confirm("Are you sure you want to Delete")) {
    form.delete(route("admin-users-delete", id));
  }
}
</script>

<template>
  <div
    class="px-4 sm:px-6 lg:px-8 w-full offset-r-0 mt-1 h-7/8 relative overflow-hidden"
  >
    <div class="md:flex md:items-center">
      <div class="md:flex-auto">
        <h1
          class="text-3xl hidden md:flex justify-center font-semibold text-gray-900"
        >
          Users
        </h1>
      </div>
    </div>
    <div class="w-full flex justify-center">
      <label for="search" class="sr-only"
        >{{ $t("company_browser.search") }}
      </label>
      <div class="relative">
        <div
          class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center"
        >
          <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </div>
        <input
          v-model="UsersSearch"
          name="searchbox"
          class="block w-full bg-white border border-gray-300 rounded-md py-2 pl-10 pr-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-1 focus:ring-slate-400 focus:border-slate-500 sm:text-sm"
          :placeholder="$t('company_browser.search')"
          type="search"
        />
      </div>
      <InertiaLink href="/admin/users/trashed">
        <TrashIcon class="h-9 w-auto ml-5 text-gray-800"
      /></InertiaLink>
    </div>
    <div class="md:mt-2 w-fit flex item-center"></div>
    <div
      class="mt-4 flex flex-col overflow-hidden h-fit border-2 max-h-full overflow-scroll-y"
    >
      <div
        class="-my-4 -mx-4 overflow-x-auto h-full overflow-y-auto sm:-mx-6 lg:-mx-8"
      >
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div
            class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
          >
            <table class="min-w-full divide-y table-fixed divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="py-3.5 pl-1 pr-1 text-left text-lg font-semibold text-gray-900 sm:pl-6 w-1/4"
                  >
                    First Name
                  </th>
                  <th
                    scope="col"
                    class="py-3.5 pl-1 pr-1 text-left text-lg font-semibold text-gray-900 sm:pl-6 w-1/4"
                  >
                    Last name
                  </th>
                  <th
                    scope="col"
                    class="lg:table-cell hidden py-3.5 pr-2 text-left text-lg font-semibold text-gray-900 pl-2 sm:pl-6 w-1/3"
                  >
                    E-mail
                  </th>
                  <th
                    scope="col"
                    class="lg:table-cell hidden py-3.5 pl-1 pr-2 text-left text-sm font-semibold text-gray-900 sm:pl-6 w-1/3"
                  >
                    Role
                  </th>

                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Remove</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="user in props.users" :key="user.id">
                  <td
                    class="whitespace-nowrap py-4 pl-4 pr-3 text-md font-medium text-gray-900 sm:pl-6"
                  >
                    <div class="text-center">
                      <div class="font-medium text-left text-gray-900">
                        {{ user.first_name }}
                      </div>
                    </div>
                  </td>
                  <td
                    class="whitespace-nowrap py-4 pl-4 pr-3 text-md font-medium text-gray-900 sm:pl-6"
                  >
                    <div class="text-center">
                      <div class="font-medium text-left text-gray-900">
                        {{ user.last_name }}
                      </div>
                    </div>
                  </td>
                  <td
                    class="whitespace-nowrap py-4 pr-3 text-md font-medium text-gray-900 sm:pl-6 lg:table-cell hidden"
                  >
                    <div class="text-left">
                      <div class="text-gray-500">{{ user.email }}</div>
                    </div>
                  </td>
                  <td
                    class="whitespace-nowrap py-4 pl-4 pr-3 text-lg font-medium text-gray-900 sm:pl-6 lg:table-cell hidden"
                  >
                    <RoleDisplay :role="user.role" />
                  </td>
                  <td
                    class="text-center whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell"
                  ></td>
                  <td
                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6"
                  >
                    <MoreInfo :user="user">
                      <RoleDisplay :role="user.role" />
                    </MoreInfo>
                  </td>
                  <td
                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6"
                  >
                    <Button
                      @click="destroy(user.id)"
                      class="hover:bg-red-700 bg-red-600 focus:ring-red-500"
                      >Remove</Button
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
