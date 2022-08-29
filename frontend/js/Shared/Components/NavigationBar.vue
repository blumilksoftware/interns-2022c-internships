<template>
  <Disclosure as="nav" class="bg-primary z-50" v-slot="{ open }">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img
              class="block h-8 w-auto"
              src="@/assets/images/navbar_logo.svg"
              alt="Workflow"
            />
          </div>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <a
                href="#"
                class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                >{{ $t("NavigationBar.Map") }}
              </a>
              <a
                href="#"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >{{ $t("NavigationBar.AddCompany") }}</a
              >
            </div>
          </div>
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex items-center">
            <Menu as="div" class="ml-3 relative">
              <div>
                <MenuButton
                  class="flex text-sm text-gray-50 rounded-full focus:outline-none focus:ring-2 focus:ring-gray-50"
                >
                  <div class="flex-shrink-0">
                    <UserIcon class="h-6 w-6 rounded-full" />
                  </div>
                </MenuButton>
              </div>

              <transition
                enter-active-class="transition ease-out duration-100"
                enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95"
              >
                <MenuItems
                  class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                  <MenuItem v-slot="{ active }">
                    <a
                      href="#"
                      :class="[
                        active ? 'bg-gray-100' : '',
                        'block px-4 py-2 text-sm text-gray-700',
                      ]"
                      >{{ $t("NavigationBar.SignIn") }}</a
                    >
                  </MenuItem>
                </MenuItems>
              </transition>
            </Menu>
            <div class="flex items-center">
              <LanguageSwitch class="flex pl-5" />
              <div class="flex pl-5">
                <a
                  href="https://github.com/blumilksoftware/internships"
                  target="_blank"
                  class="bg-gray-800 p-1 rounded-full text-gray-400 focus:outline-none focus:ring-2 focus:ring-white"
                >
                  <span class="sr-only">View code</span>
                  <CodeIcon class="h-6 w-6" aria-hidden="true" />
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="-mr-2 flex sm:hidden">
          <LanguageSwitch class="flex pr-3" />
          <DisclosureButton
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
          >
            <span class="sr-only">Open main menu</span>
            <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
            <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
        </div>
      </div>
    </div>
    <DisclosurePanel class="sm:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <DisclosureButton
          as="a"
          href="#"
          class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium"
          >{{ $t("NavigationBar.Map") }}</DisclosureButton
        >
        <DisclosureButton
          as="a"
          href="#"
          class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
        >
          {{ $t("NavigationBar.AddCompany") }}
        </DisclosureButton>
      </div>
      <div class="pt-4 pb-3 border-t border-gray-700">
        <div class="flex items-center px-5"></div>
        <div class="mt-3 px-2 space-y-1">
          <DisclosureButton
            as="a"
            href="#"
            class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700"
          >
            {{ $t("NavigationBar.SignIn") }}</DisclosureButton
          >
        </div>
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>

<script setup>
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
} from "@headlessui/vue";
import { UserIcon, MenuIcon, XIcon, CodeIcon } from "@heroicons/vue/outline";
import LanguageSwitch from "./LanguageSwitch.vue";
</script>