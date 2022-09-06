<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import {
    UsersIcon,
    OfficeBuildingIcon,
    TrashIcon
  } from "@heroicons/vue/outline";
  const navigation = [

    {
      name: "Companies",
      href: "/admin/companies",
      icon: OfficeBuildingIcon,
      current: false,
    },
    {
      name: "Users",
      href: "/admin/users",
      icon: UsersIcon,
      current: false,
    },
]
</script>

<template>
<Disclosure v-slot="{ open }">
        <DisclosureButton class="flex y-0 text-gray-600 text-sm text-center hover:text-gray-500 justify-center flex-shrink-0 h-6 w-6">
            <TrashIcon class="text-gray-400 hover:text-gray-500 flex-shrink-0 h-12 w-12"/>
        </DisclosureButton>
        <DisclosurePanel>
          sadFfzxf AsdAsf ASF 
        </DisclosurePanel>
      </Disclosure>
</template>