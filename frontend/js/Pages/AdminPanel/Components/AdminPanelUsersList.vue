<script setup>
import BlueButton from "@/js/Shared/Components/BlueButton.vue";
import RedButton from "@/js/Shared/Components/RedButton.vue";
  const props= defineProps({
      users: Object,
  
    })
  </script>
  
<template>
  <div class="px-4 sm:px-5 w-4/5 lg:px-8 mt-1 h-full">
    <div class="md:flex md:items-center">
      <div class="md:flex-auto">
        <h1 class="text-3xl hidden md:flex justify-center font-semibold text-gray-900">Users</h1>
      </div>
    </div>
    <div class="md:mt-2 w-fit flex item-center">
    </div>
    <div class="mt-4 flex flex-col">
      <div class="-my-4 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div
            class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
          >
            <table class="min-w-full divide-y table-fixed divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="py-3.5 pl-1 pr-2 text-center text-sm font-semibold text-gray-900 sm:pl-6 w-1/3">Name</th>
            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900 lg:table-cell">Companies</th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Remove</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="user in props.users" :key="user.id">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                    <div class="text-center">
                        <div class="font-medium text-center text-gray-900">
                          {{ user.first_name }} {{ user.last_name }}
                        </div>
                        <div class="text-gray-500">{{ user.email }}</div>
                    </div>
                  </td>
                  <td class="text-center whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">
                    <span
                      class=" text-center inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-blue-800"
                      >5</span
                    >
                  </td>
                  <td
                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6"
                  >
                  <BlueButton>More</BlueButton>
                  </td>
                  <td
                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6"
                  >
                  <RedButton>Remove</RedButton>
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
