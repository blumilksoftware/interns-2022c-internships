<script setup>
import { computed, reactive } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
} from "@headlessui/vue";
import {
  UserIcon,
  Bars3Icon,
  XMarkIcon,
  CodeBracketIcon,
} from "@heroicons/vue/24/outline";
import LanguageSwitch from "./LanguageSwitch.vue";
import route from "ziggy";

const navItems = reactive([
  {
    labelKey: "company_browser.companies_list",
    routeName: "index",
    show: true,
  },
  {
    labelKey: "navigation_bar.manage_companies",
    routeName: "company-manage",
    show: computed(() => usePage().props.value.auth.user),
  },
  {
    labelKey: "navigation_bar.add_company",
    routeName: "company-create",
    show: true,
  },
]);
</script>

<template>
  <Disclosure
    as="nav"
    class="bg-primary z-50 w-full ssm:w-screen"
    v-slot="{ open }"
  >
    <div class="mx-auto px-4 md:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img
              class="block h-8 w-auto"
              src="@/assets/images/navbar_logo.svg"
              alt="Workflow"
            />
          </div>
          <div class="hidden lg:block lg:ml-6">
            <div class="flex space-x-4">
              <template v-for="navItem in navItems" :key="navItem.routeName">
                <template v-if="navItem.show">
                  <InertiaLink
                    :href="route(navItem.routeName)"
                    class="hover:text-white px-3 py-2 border-solid border-b-2"
                    :class="
                      route().current() === navItem.routeName
                        ? 'text-white font-bold border-white border-solid border-b-2'
                        : 'text-gray-400 border-gray-400'
                    "
                  >
                    {{ $t(navItem.labelKey) }}
                  </InertiaLink>
                </template>
              </template>
            </div>
          </div>
        </div>
        <div class="hidden lg:ml-6 lg:block">
          <div class="flex items-center">
            <p
              v-if="$page.props.auth.user"
              dusk="logged-as-name"
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
                  <CodeBracketIcon class="h-6 w-6" aria-hidden="true" />
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="-mr-2 flex lg:hidden">
          <LanguageSwitch class="flex pr-3" />
          <DisclosureButton
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
          >
            <span class="sr-only">Open main menu</span>
            <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
            <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
        </div>
      </div>
    </div>
    <DisclosurePanel class="lg:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <template v-for="navItem in navItems" :key="navItem.routeName">
          <div class="flex flex-col" v-if="navItem.show">
            <DisclosureButton
              v-if="navItem.show"
              as="a"
              :href="route(navItem.routeName)"
              class="inline-flex hover:text-white px-3 py-2"
              :class="
                route().current() === navItem.routeName
                  ? 'text-white font-bold'
                  : 'text-gray-400'
              "
            >
              {{ $t(navItem.labelKey) }}
            </DisclosureButton>
          </div>
        </template>
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
        </div>
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>
