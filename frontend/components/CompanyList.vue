<template>
  <div
    class="shadow ring-1 ring-black ring-opacity-5 md:rounded-lg overflow-x-hidden overflow-y-scroll"
  >
    <table class="min-w-full divide-y divide-gray-300">
      <tbody class="divide-y divide-gray-200 bg-white overflow-hidden py-5">
        <tr v-for="person in people" :key="person.email">
          <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
            <div class="flex items-center">
              <div class="h-10 w-10 flex-shrink-0">
                <img
                  class="h-10 w-10 rounded-full"
                  :src="person.image"
                  alt=""
                />
              </div>
              <div class="ml-4">
                <div class="font-medium text-gray-900">{{ person.name }}</div>
                <div class="text-gray-500">{{ person.email }}</div>
              </div>
            </div>
          </td>
          <td>
            <ChevronRightIcon
              class="h-5 w-5 text-gray-400"
              aria-hidden="true"
            />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ChevronRightIcon } from "@heroicons/vue/solid";
import PlaceholderImage from "@/assets/images/blumilklogo.png";
const people = [
  {
    name: "Some Company",
    email: "some.company@example.com",
    image: PlaceholderImage,
  },
];
</script>
