<script setup>
import { ref, watch } from "vue";
import Treeselect from "@tkmam1x/vue3-treeselect";
import "@tkmam1x/vue3-treeselect/dist/vue3-treeselect.css";
import StatusDisplay from "./StatusDisplay.vue";
import Button from "@/js/Shared/Components/Button.vue";
import ApproveButton from "../../../Shared/Components/ApproveButton.vue";
import { useForm } from '@inertiajs/inertia-vue3'
import { TrashIcon } from "@heroicons/vue/outline";

const props = defineProps({
  companies: Object,
  filter: String,
});
const statuses = [
  {
    id: "verified",
    label: "Active",
  },
  {
    id: "pending_edited",
    label: "Edited",
  },
  {
    id: "pending_new",
    label: "New",
  },
];
let statusSelect = ref(props.filter.statusSelect);
const emit = defineEmits(["selected"]);
watch([statusSelect], () => {
  emit("selected", statusSelect);
});
const form = useForm();
function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('admin-companies-delete', id));
    }
    
}
function approve(id) {
    if (confirm("Are you sure you want to Approve")) {
        form.put(route('admin-companies-update', id));
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
          Companies
        </h1>
      </div>
    </div>
    <div class="md:mt-2 flex item-center">
      <Treeselect
        :options="statuses"
        :multiple="false"
        :show-count="true"
        :disable-branch-nodes="true"
        placeholder="Choose company status"
        v-model="statusSelect"
      />
      <InertiaLink href="/admin/trashed"> <TrashIcon class="h-9 w-auto ml-5 text-gray-800" /></InertiaLink>
    
    </div>
    
    <div
      class="mt-4 flex flex-col overflow-hidden overflow-scroll-x h-fit border-2 max-h-full"
    >
      <div
        class="-my-4 -mx-4 overflow-x-auto h-full overflow-y-auto sm:-mx-6 lg:-mx-8"
      >
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div
            class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
          >
            <table
              class="w-full divide-y table-auto divide-gray-300 max-h-full"
            >
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="py-3.5 pl-4 pr-1 text-left text-sm font-semibold text-gray-900 sm:pl-6 w-1/3 min-w-md"
                  >
                    Name
                  </th>
                  <th
                    scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell w-1/4 min-w-md"
                  >
                    City
                  </th>
                  <th
                    scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell w-1/4 min-w-md"
                  >
                    E-Mail
                  </th>
                  <th
                    scope="col"
                    class="hidden px-3 py-3.5 text-center text-sm font-semibold text-gray-900 lg:table-cell w-1/4 min-w-md"
                  >
                    Status
                  </th>
                  <th
                    scope="col"
                    class="relative py-3.5 pl-3 pr-4 sm:pr-6 w-1/6"
                  >
                    <span class="sr-only">Edit</span>
                  </th>
                  <th
                    scope="col"
                    class="relative py-3.5 pl-3 pr-4 sm:pr-6 w-1/6"
                  >
                    <span class="sr-only">Remove</span>
                  </th>
                  <th
                    scope="col"
                    class="relative py-3.5 pl-3 pr-4 sm:pr-6 w-1/6"
                  >
                    <span class="sr-only">Approve</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white max-h-full">
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
                        <div class="text-gray-500">{{ company.email }}</div>
                      </div>
                    </div>
                  </td>
                  <td
                    class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell"
                  >
                    <div class="text-gray-900">{{ company.address.city }}</div>
                  </td>
                  <td
                    class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell"
                  >
                    <div class="text-gray-600">
                      {{ company.contact_details.email }}
                    </div>
                  </td>
                  <td
                    class="hidden whitespace-nowrap px-3 py-4 text-center text-3xl text-gray-500 lg:table-cell"
                  >
                    <StatusDisplay :status="company.status" />
                  </td>
                  <td
                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6"
                  >
                    <Button class="hover:bg-blue-700 bg-blue-600 focus:ring-blue-500">Edit</Button>
                  </td>
                  <td
                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6"
                  >
                  <Button @click="destroy(company.id)" class="hover:bg-red-700 bg-red-600 focus:ring-red-500">Remove</Button>
                  </td>
                  <td
                    class="relative whitespace-nowrap py-1 pl-3 pr-1 text-center text-sm font-medium sm:pr-3"
                  >
                    <ApproveButton @click="approve(company.id)" :status="company.status" />
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
