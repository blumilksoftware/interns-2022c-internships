<template>
  <Disclosure as="nav" class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <div class="noselect flex-shrink-0 flex items-center">
            <router-link to="/" class="logo noselect" title="Home">
              Znajdź Praktyki
            </router-link>
          </div>
          <div class="noselect hidden sm:ml-6 sm:flex sm:space-x-8">
            <a
              @click="goMap()"
              title="Map"
              class="border-transparent text-gray-500 hover:border-indigo-400 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
            >
              Mapa firm
            </a>
            <a
              @click="goInfo()"
              title="Infomation"
              class="border-transparent text-gray-500 hover:border-indigo-400 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
            >
              Informacje o praktykach
            </a>

            <a
              @click="goFiles()"
              title="Files to download"
              class="border-transparent text-gray-500 hover:border-indigo-400 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
            >
              Pliki do pobrania
            </a>

            <a
              @click="goCoop()"
              title="Cooperation"
              class="border-transparent text-gray-500 hover:border-indigo-400 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
            >
              Współpraca
            </a>
          </div>
        </div>
      </div>
    </div>

    <DisclosurePanel class="sm:hidden">
      <div class="pt-2 pb-3 space-y-1">
        <a
          @click="goMap()"
          title="Map"
          class="border-transparent text-gray-500 hover:border-indigo-400 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
        >
          Mapa firm
        </a>
        <a
          @click="goInfo()"
          title="Information"
          class="noselect text-gray-500 hover:bg-gray-50 hover:border-indigo-400 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium"
          >Informacje o praktykach</a
        >
        <a
          @click="goFiles()"
          title="Files to download"
          class="noselect border-transparent text-gray-500 hover:bg-gray-50 hover:border-indigo-400 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium"
          >Pliki do pobrania</a
        >

        <a
          @click="goCoop()"
          title="Cooperation"
          class="noselect border-transparent text-gray-500 hover:bg-gray-50 hover:border-indigo-400 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium"
          >Współpraca</a
        >
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>

<script>
import { ref } from "vue";
import { Disclosure, DisclosurePanel } from "@headlessui/vue";

export default {
  components: {
    Disclosure,
    DisclosurePanel,
  },
  setup() {
    const open = ref(false);

    return {
      open,
    };
  },
  methods: {
    goMap() {
      window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth",
      });
    },
    goInfo() {
      document.getElementById("info").scrollIntoView({
        behavior: "smooth",
      });
    },
    goFiles() {
      document.getElementById("files").scrollIntoView({
        behavior: "smooth",
        block: "center",
      });
    },

    goCoop() {
      document.getElementById("cooperation").scrollIntoView({
        behavior: "smooth",
      });
    },
  },
};
</script>

<style lang="pcss" scoped>
.logo {
  font-family: Poppins;
  font-size: 20px;
  font-weight: 700;
  margin-right: 30px;
}
.bg-white {
  background-color: var(--white);
}

.max-w-7xl {
  max-width: none;
}
</style>
