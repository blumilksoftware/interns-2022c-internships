<script setup>
  import LocationIcon from "@/assets/icons/locationIcon.svg";
  import { onMounted } from "vue";
  import { XMarkIcon, EnvelopeIcon, GlobeAltIcon, DevicePhoneMobileIcon } from "@heroicons/vue/24/outline";
  import MarkdownEditor from "@/js/Shared/Components/MarkdownEditor.vue";
  
  const props = defineProps({
    company: Object,
  });
  
  const emit = defineEmits(["close", "destroy", "update", "zoom"]);
  function onClose() {
    emit("close");
  }
  
  function onDestroy() {
    emit("destroy");
  }
  
  function onUpdate() {
    emit("update");
  }
  
  function onZoom() {
    emit("zoom", props.company.id);
  }
  
  onMounted(() => {
    emit("zoom", props.company.id);
  });
  </script>
  
  <template>
    <div>
      <div class="sticky h-0 right-10 w-full flex justify-end">
        <button class="sticky right-0" @click="onClose">
          <XMarkIcon class="pr-5 pt-5 h-12 w-12 text-gray-700" />
        </button>
      </div>
      <div
        class="shadow h-full ring-1 ring-black ring-opacity-5 md:rounded-lg overflow-x-hidden overflow-y-scroll"
      >
        <div class="mt-4 p-4 px-10 pt-1 text-left sm:text-left">
          <div>
            <h1 class="text-gray-900 pb-2 text-2xl text-center">{{ company.name }}</h1>
            <hr class="border-b border-gray-300" />
          </div>
          <p
            class="pt-2 text-gray-600 text-xs sm:text-sm flex items-center justify-center  mb-4"
          >
            <img
              class="h-5 w-10 hover:h-6 hover:w-11"
              :src="LocationIcon"
              @click="onZoom"
            />{{ company.location.name }}
          </p>
  
          <div class="flex flex-row justify-center mt-5 px-10 sm:py-4 gap-2 sm:gap-4 mb-5">
          <img
            class="h-24 w-24 sm:h-36 sm:w-36 shadow-lg rounded-lg border-2"
            :src="'/storage/images/' + company.logo"
            alt=""
          />
          <div class="flex flex-col justify-center sm:gap-2 rounded-lg shadow-md p-2 bg-white">
            <p class="hidden sm:flex justify-center font-semibold">Dane kontaktowe</p>
            <div class="flex items-center"><EnvelopeIcon class="h-6 mx-2"/><a class="text-blue-700 font-medium" :href="'mailto:' + company.contact_details.email">{{ company.contact_details.email }}</a></div>
            <div class="flex items-center"><GlobeAltIcon class="h-6 mx-2"/><a class="text-blue-700 font-medium" :href=company.contact_details.website_url target="_blank">{{ company.contact_details.website_url }}</a></div>
            <div class="flex items-center"><DevicePhoneMobileIcon class="h-6 mx-2"/>{{ company.contact_details.phone_number }}</div>
          </div>
        </div>

          <div class="mt-2 rounded-lg p-2 bg-white shadow-md">
          <p class="font-medium">Firma poszukuje</p>
          <ul class="list-decimal list-inside">
            <li v-for="specialization in company.specializations" :key="company.specializations.id">
              <InertiaLink
                  :href="route('index', {specialization: specialization.id})"
              >
              {{ specialization.label }}
              </InertiaLink>
            </li>
          </ul>
          </div>
  
          <div class="mt-2 rounded-lg p-2 bg-white shadow-md">
            <p class="font-medium">Opis</p>
            <MarkdownEditor
            :previewOnly="true"
            class="!bg-transparent w-full"
            :modelValue="company.description"
          />
          </div>
        </div>
        <div class="justify-center mx-auto gap-2 flex w-3/4">
          <div
            type="button"
            @click="onUpdate"
            v-if="
              company.status === 'pending_new' &&
              $page.props.auth.can.manage_companies
            "
            class="cursor-pointer mt-2 relative w-60 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
          >
            {{ $t("company_browser.verify_button") }}
          </div>
          <div
            type="button"
            v-if="
              $page.props.auth.user &&
              (company.owner_id === $page.props.auth.user.id ||
                $page.props.auth.can.manage_companies)
            "
            @click="onDestroy"
            class="cursor-pointer mt-2 relative w-60 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
          >
            {{ $t("company_browser.delete_button") }}
          </div>
        </div>
      </div>
    </div>
  </template>