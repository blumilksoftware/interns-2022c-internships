<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div
    class="xl:m-auto my-10 mx-8 max-w-4xl px-0 sm:px-0 border-1 border-gray-700 shadow-md rounded-lg bg-white w-full lg:px-8"
  >
    <div class="mx-5 my-5 max-w-3xl text-lg font-bold">
      Welcome!
      <div clas="flex justify center">
        <h1 class="text-center">Companies group by status</h1>
        <ul role="list" class="mt-3 flex flex-col">
          <li
            v-for="company in companies"
            :key="company.name"
            class="flex rounded-md shadow-sm my-3"
          >
            <div
              :class="[
                company.bgColor,
                'flex-shrink-0 flex items-center  w-16 text-white text-sm  font-medium rounded-l-md',
              ]"
            ></div>
            <div
              class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white"
            >
              <div class="flex-1 truncate px-4 py-2 text-md">
                <InertiaLink
                  :href="company.href"
                  class="font-medium text-gray-900 hover:text-gray-600"
                  >{{ company.name }}</InertiaLink
                >
                <p class="text-gray-500">{{ company.quantity }}</p>
              </div>
            </div>
          </li>
        </ul>
        <div class="mx-5 mt-11 max-w-3xl text-md text-end">
          For details check out tabs on the left
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  active: Number,
  created: Number,
  edited: Number,
});

const companies = [
  {
    name: "Actives ",
    href: "/admin/companies?status=verified",
    quantity: props.active,
    bgColor: "bg-green-500",
  },
  {
    name: "Changed ",
    href: "/admin/companies?status=pending_edited",
    quantity: props.edited,
    bgColor: "bg-blue-500",
  },
  {
    name: "New",
    href: "/admin/companies?status=pending_new",
    quantity: props.created,
    bgColor: "bg-yellow-500",
  },
  { name: "Outdated", href: "#", quantity: 1, bgColor: "bg-slate-500" },
];
</script>
