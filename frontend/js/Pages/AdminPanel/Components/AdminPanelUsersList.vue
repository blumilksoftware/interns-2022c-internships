
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
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="py-3.5 pl-1 pr-2 text-center text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900 lg:table-cell">Companies</th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Remove</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="user in users" :key="user.email">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                    <div class="text-center">
                        <div class="font-medium text-center text-gray-900">
                          {{ user.name }}
                        </div>
                        <div class="text-gray-500">{{ user.email }}</div>
                    </div>
                  </td>
                  <td class="text-center whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">
                    <span
                      class=" text-center inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-blue-800"
                      >{{user.companies}}</span
                    >
                  </td>
                  <td
                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6"
                  >
                    <a href="#" class="text-indigo-600 hover:text-indigo-900"
                      >More<span class="sr-only">, {{ user.name }}</span></a
                    >
                  </td>
                  <td
                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-medium sm:pr-6"
                  >
                    <div
                      @click="PopAlert = true"
                      class="text-red-600 hover:text-red-900 cursor-pointer"
                    >
                      Remove<span class="sr-only">, {{ user.name }}</span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <TransitionRoot as="template" :show="PopAlert">
      <Dialog as="div" class="relative z-10" @close="PopAlert = false">
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="ease-in duration-200"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
          />
        </TransitionChild>

        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div
            class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
          >
            <TransitionChild
              as="template"
              enter="ease-out duration-300"
              enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              enter-to="opacity-100 translate-y-0 sm:scale-100"
              leave="ease-in duration-200"
              leave-from="opacity-100 translate-y-0 sm:scale-100"
              leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
              <DialogPanel
                class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
              >
                <div class="sm:flex sm:items-start">
                  <div
                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
                  >
                    <ExclamationIcon
                      class="h-6 w-6 text-red-600"
                      aria-hidden="true"
                    />
                  </div>
                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <DialogTitle
                      as="h3"
                      class="text-lg font-medium leading-6 text-gray-900"
                      >Warrning</DialogTitle
                    >
                    <div class="mt-2">
                      <p class="text-sm text-gray-500">
                        Are you sure you want to remove this data? All this
                        data will be permanently removed forever. This action cannot be undone.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:ml-10 sm:flex sm:pl-4">
                  <button
                    type="submit"
                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:w-auto sm:text-sm"
                    @click="PopAlert = false"
                  >
                    Remove
                  </button>
                  <button
                    type="button"
                    class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    @click="PopAlert = false"
                    ref="cancelButtonRef"
                  >
                    Cancel
                  </button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </div>
</template>

<script setup>
import PlaceholderImage from "@/assets/images/blumilklogo.png";
import { ref } from "vue";
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { ExclamationIcon } from "@heroicons/vue/solid"
const PopAlert =ref(false)
const users = [
  {
    name: "Example user",
    email: "example.user@example.com",
    companies: "1",
    
  },
  {
    name: "Example user",
    email: "example.user@example.com",
    companies: "2",
  },{
    name: "Example user",
    email: "example.user@example.com",
    companies: "3",
  },{
    name: "Example user",
    email: "example.user@example.com",
    companies: "1",
  },{
    name: "Example user",
    email: "example.user@example.com",
    companies: "1",
  },
]
</script>
