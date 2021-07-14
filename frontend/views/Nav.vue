<template>
  <Disclosure as="nav" class="bg-white shadow" v-slot="{ open }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <div class="flex-shrink-0 flex items-center">
            <router-link to="/home">
              <p class="logo">Znajdź Praktyki</p>
            </router-link>
          </div>
          <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
            <a
              href="#"
              class="
                border-indigo-500
                text-gray-900
                inline-flex
                items-center
                px-1
                pt-1
                border-b-2
                text-sm
                font-medium
              "
            >
              Informacje o praktykach
            </a>
            <a
              href="#"
              class="
                border-transparent
                text-gray-500
                hover:border-gray-300 hover:text-gray-700
                inline-flex
                items-center
                px-1
                pt-1
                border-b-2
                text-sm
                font-medium
              "
            >
              Regulamin praktyk
            </a>
            <a
              href="#"
              class="
                border-transparent
                text-gray-500
                hover:border-gray-300 hover:text-gray-700
                inline-flex
                items-center
                px-1
                pt-1
                border-b-2
                text-sm
                font-medium
              "
            >
              Pliki do pobrania
            </a>
            <a
              href="#"
              class="
                border-transparent
                text-gray-500
                hover:border-gray-300 hover:text-gray-700
                inline-flex
                items-center
                px-1
                pt-1
                border-b-2
                text-sm
                font-medium
              "
            >
              Współpraca
            </a>
          </div>
        </div>
        <div class="hidden sm:ml-6 sm:flex sm:items-center">
          <!-- Profile dropdown -->
          <Menu as="div" class="ml-3 relative">
            <div>
              <MenuButton
                class="
                  bg-white
                  rounded-full
                  flex
                  text-sm
                  focus:outline-none
                  focus:ring-2
                  focus:ring-offset-2
                  focus:ring-indigo-500
                "
              >
                <span class="sr-only">Open user menu</span>
              </MenuButton>
            </div>
            <transition
              enter-active-class="transition ease-out duration-200"
              enter-from-class="transform opacity-0 scale-95"
              enter-to-class="transform opacity-100 scale-100"
              leave-active-class="transition ease-in duration-75"
              leave-from-class="transform opacity-100 scale-100"
              leave-to-class="transform opacity-0 scale-95"
            >
              <MenuItems
                class="
                  origin-top-right
                  absolute
                  right-0
                  mt-2
                  w-48
                  rounded-md
                  shadow-lg
                  py-1
                  bg-white
                  ring-1 ring-black ring-opacity-5
                  focus:outline-none
                "
              >
                <MenuItem v-slot="{ active }">
                  <a
                    href="#"
                    :class="[
                      active ? 'bg-gray-100' : '',
                      'block px-4 py-2 text-sm text-gray-700',
                    ]"
                    >Your Profile</a
                  >
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <a
                    href="#"
                    :class="[
                      active ? 'bg-gray-100' : '',
                      'block px-4 py-2 text-sm text-gray-700',
                    ]"
                    >Settings</a
                  >
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <a
                    href="#"
                    :class="[
                      active ? 'bg-gray-100' : '',
                      'block px-4 py-2 text-sm text-gray-700',
                    ]"
                    >Sign out</a
                  >
                </MenuItem>
              </MenuItems>
            </transition>
          </Menu>
        </div>
        <div class="-mr-2 flex items-center sm:hidden">
          <!-- Mobile menu button -->
          <DisclosureButton
            class="
              inline-flex
              items-center
              justify-center
              p-2
              rounded-md
              text-gray-400
              hover:text-gray-500 hover:bg-gray-100
              focus:outline-none
              focus:ring-2
              focus:ring-inset
              focus:ring-indigo-500
            "
          >
            <span class="sr-only">Open main menu</span>
            <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
            <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
        </div>
      </div>
    </div>

    <DisclosurePanel class="sm:hidden">
      <div class="pt-2 pb-3 space-y-1">
        <!-- Current: "bg-indigo-50 border-indigo-500 text-indigo-700", Default: "border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700" -->
        <a
          href="#"
          class="
            bg-indigo-50
            border-indigo-500
            text-indigo-700
            block
            pl-3
            pr-4
            py-2
            border-l-4
            text-base
            font-medium
          "
          >Dashboard</a
        >
        <a
          href="#"
          class="
            border-transparent
            text-gray-500
            hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700
            block
            pl-3
            pr-4
            py-2
            border-l-4
            text-base
            font-medium
          "
          >Team</a
        >
        <a
          href="#"
          class="
            border-transparent
            text-gray-500
            hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700
            block
            pl-3
            pr-4
            py-2
            border-l-4
            text-base
            font-medium
          "
          >Projects</a
        >
        <a
          href="#"
          class="
            border-transparent
            text-gray-500
            hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700
            block
            pl-3
            pr-4
            py-2
            border-l-4
            text-base
            font-medium
          "
          >Calendar</a
        >
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>

<script>
import { ref } from "vue";
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
} from "@headlessui/vue";
import { MenuIcon, XIcon } from "@heroicons/vue/outline";

export default {
  components: {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    // BellIcon,
    MenuIcon,
    XIcon,
  },
  setup() {
    const open = ref(false);

    return {
      open,
    };
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");

.logo {
  font-family: Poppins;
  font-size: 20px;
  font-weight: 700;
  margin-right: 30px;
}
.bg-white {
  background-color: white;
}
</style>
