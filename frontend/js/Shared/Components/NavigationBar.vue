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
import route from "ziggy";
</script>

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
              <InertiaLink
                :href="route('index')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >{{ $t("navigation_bar.map") }}</InertiaLink
              >
              <InertiaLink
                v-if="$page.props.auth.user"
                :href="route('company-index')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >{{ $t("navigation_bar.own_companies") }}</InertiaLink
              >
              <InertiaLink
                v-if="$page.props.auth.can.manage_companies"
                :href="route('company-manage')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >{{ $t("navigation_bar.manage_companies") }}</InertiaLink
              >
              <InertiaLink
                :href="route('company-create')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                >{{ $t("navigation_bar.add_company") }}</InertiaLink
              >
            </div>
          </div>
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex items-center">
            <p
              v-if="$page.props.auth.user"
              class="text-gray-300 text-sm font-medium"
            >
              {{ $t("navigation_bar.logged_as") }}:
              {{ $page.props.auth.user.full_name }}
            </p>
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
                  <MenuItem v-if="!$page.props.auth.user" v-slot="{ active }">
                    <InertiaLink
                      :href="route('login')"
                      :class="[
                        active ? 'bg-gray-100' : '',
                        'block px-4 py-2 text-sm text-gray-700',
                      ]"
                      >{{ $t("buttons.sign_in_button") }}</InertiaLink
                    >
                  </MenuItem>
                  <MenuItem v-if="$page.props.auth.user" v-slot="{ active }">
                    <InertiaLink
                      :href="route('logout')"
                      :class="[
                        active ? 'bg-gray-100' : '',
                        'block px-4 py-2 text-sm text-gray-700',
                      ]"
                      >{{ $t("buttons.logout_button") }}</InertiaLink
                    >
                  </MenuItem>
                  <MenuItem v-if="$page.props.auth.user" v-slot="{ active }">
                    <InertiaLink
                      :href="route('admin')"
                      :class="[
                        active ? 'bg-gray-100' : '',
                        'block px-4 py-2 text-sm text-gray-700',
                      ]"
                      >Admin panel</InertiaLink
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
          :href="route('index')"
          class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
          >{{ $t("navigation_bar.map") }}</DisclosureButton
        >
        <DisclosureButton
          v-if="$page.props.auth.user"
          as="a"
          :href="route('company-index')"
          class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
        >
          {{ $t("navigation_bar.manage_companies") }}</DisclosureButton
        >
        <DisclosureButton
          as="a"
          :href="route('company-create')"
          class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
        >
          {{ $t("navigation_bar.add_company") }}
        </DisclosureButton>
      </div>
      <div class="pt-4 pb-3 border-t border-gray-700">
        <div class="flex items-center px-5"></div>
        <div class="mt-3 px-2 space-y-1">
          <DisclosureButton
            v-if="!$page.props.auth.user"
            as="a"
            :href="route('login')"
            class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700"
          >
            {{ $t("buttons.sign_in_button") }}</DisclosureButton
          >
          <p
            v-if="$page.props.auth.user"
            class="px-3 py-2 text-gray-300 text-base font-medium"
          >
            {{ $t("navigation_bar.logged_as") }}:
            {{ $page.props.auth.user.full_name }}
          </p>
          <DisclosureButton
            v-if="$page.props.auth.user"
            as="a"
            :href="route('logout')"
            class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700"
          >
            {{ $t("buttons.logout_button") }}</DisclosureButton
          >
          <DisclosureButton
          as="a"
          :href="route('admin')"
          class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
        >
          Admin panel
        </DisclosureButton>
        </div>
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>
