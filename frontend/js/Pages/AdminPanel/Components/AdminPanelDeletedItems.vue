<script setup>
  import Button from "@/js/Shared/Components/Button.vue";
   import {
    UsersIcon,
  } from "@heroicons/vue/outline";
  import { useForm } from '@inertiajs/inertia-vue3';
  const props = defineProps({
    companies: Object,
    users: Object,
  });
  const form = useForm();
function UserRestore(id) {
    if (confirm("Are you sure you want to restore")) {
        form.put(route('admin-trashed-users', id));
    }
}
function CompanyRestore(id) {
    if (confirm("Are you sure you want to restore")) {
        form.put(route('admin-trashed-companies', id));
    }
}
  </script>
  <template>
       <div class="overflow-hidden rounded-lg w-full h-full bg-white shadow overflow-y-auto">
  <div class="px-4 py-5 sm:p-6">
      <h1
        class="text-lg hidden md:flex justify-center font-semibold text-gray-900"
      >
        Deleted 
      </h1>
      <table class="min-w-full divide-y mt-2 divide-gray-100">
            <thead class="bg-gray-50">
              <tr>
                <th
                  scope="col"
                  class="py-3.5 pl-1 pr-1 text-center text-sm font-semibold text-gray-900 sm:pl-6 "
                >
                  Name
                </th>
                <th
                  scope="col"
                  class="py-3.5 pl-1 pr-1 text-center text-sm font-semibold text-gray-900 sm:pl-6"
                >
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white max-h-full overflow-y-auto">
                <tr v-for="user in props.users" :key="user.id">
                <td
                  class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
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
                <td class="item-end">
                  <Button @click="UserRestore(user.id)" class="hover:bg-orange-700 bg-orange-600 focus:ring-orange-500">Recover</Button>
                </td>
                </tr>
                <tr v-for="company in props.companies" :key="company.id">
                <td
                  class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                >
                  <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0">
                      <img
                        class="h-10 w-10 rounded-lg"
                        :src="'/storage/images/' + company.logo"
                        alt=""
                      />
                    </div>
                    <div class="ml-4">
                      <div class="font-medium text-gray-900 overflow-hidden">
                        {{ company.name }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="item-end">
                  <Button @click="CompanyRestore(company.id)" class="hover:bg-orange-700 bg-orange-600 focus:ring-orange-500">Recover</Button>
                </td>
                </tr>
                </tbody>
            </table>
  </div>
</div>
  </template>