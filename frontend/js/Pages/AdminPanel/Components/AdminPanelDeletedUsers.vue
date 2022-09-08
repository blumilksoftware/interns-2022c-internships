<script setup>
import Button from "@/js/Shared/Components/Button.vue";
import { UsersIcon } from "@heroicons/vue/outline";
import { useForm } from "@inertiajs/inertia-vue3";
import MoreInfo from "./MoreInfoButtonUser.vue";
import RoleDisplay from "./RoleDisplay.vue";

const props = defineProps({
  users: Object,
});
const form = useForm();
function UserRestore(id) {
  if (confirm("Are you sure you want to restore")) {
    form.put(route("admin-trashed-users-restore", id));
  }
}
</script>
<template>
  <div
    class="overflow-hidden rounded-lg w-full h-full bg-white shadow overflow-y-auto"
  >
    <div class="px-4 py-5 sm:p-6">
      <h1
        class="text-lg hidden md:flex justify-center font-semibold text-gray-900"
      >
        {{ $t("admin_panel.deleted_users") }}
      </h1>
      <table class="min-w-full divide-y mt-2 divide-gray-100">
        <thead class="bg-gray-50">
          <tr>
            <th
              scope="col"
              class="py-3.5 pl-1 pr-1 text-center text-sm font-semibold text-gray-900 sm:pl-6"
            >
              {{ $t("registration.first_name") }}
              {{ $t("registration.last_name") }}
            </th>
            <th
              scope="col"
              class="py-3.5 pl-1 pr-1 text-center text-sm font-semibold text-gray-900 sm:pl-6"
            ></th>
          </tr>
        </thead>
        <tbody
          class="divide-y divide-gray-200 bg-white max-h-full overflow-y-auto"
        >
          <tr v-for="user in props.users" :key="user.id">
            <td
              class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-center mx-auto text-gray-900 sm:pl-6"
            >
              <div class="flex items-center">
                <div class="h-10 w-10 flex-shrink-0">
                  <UsersIcon />
                </div>
                <div class="ml-4">
                  <div class="font-medium text-gray-900 overflow-hidden">
                    {{ user.full_name }}
                  </div>
                </div>
              </div>
            </td>
            <td>
              <div
                class="py-3.5 pl-1 pr-1 text-center text-sm font-semibold text-gray-900 sm:pl-6"
              >
                <MoreInfo :user="user">
                  <RoleDisplay :role="user.role" />
                </MoreInfo>
                <Button
                  @click="UserRestore(user.id)"
                  class="hover:bg-orange-700 bg-orange-600 focus:ring-orange-500 ml-5"
                  >{{ $t("buttons.restore_button") }}</Button
                >
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
