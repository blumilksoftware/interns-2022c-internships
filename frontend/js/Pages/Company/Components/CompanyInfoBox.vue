<script setup>
import LocationIcon from "@/assets/icons/locationIcon.svg"
import { onMounted } from "vue"
import {
  EnvelopeIcon,
  GlobeAltIcon,
  DevicePhoneMobileIcon,
  TrashIcon,
  ArrowSmallLeftIcon,
  LinkIcon,
} from "@heroicons/vue/24/outline"
import MarkdownEditor from "@/js/Shared/Components/MarkdownEditor.vue"
import { useToast } from "vue-toastification"
import { useI18n } from "vue-i18n"

const toast = useToast()
const i18n = useI18n()

const props = defineProps({
  company: Object,
})

const emit = defineEmits(["close", "destroy", "update", "zoom"])
function onClose() {
  emit("close")
}

function onDestroy() {
  emit("destroy")
}

function onUpdate() {
  emit("update")
}

function onZoom() {
  emit("zoom", props.company.id)
}

onMounted(() => {
  emit("zoom", props.company.id)
})

async function copyUrl() {
  try {
    await navigator.clipboard.writeText(window.location.href)
    toast.success(i18n.t("company_browser.link_copied"))
  } catch (err) {
    toast.error(i18n.t("company_browser.link_not_copied"))
  }
}
</script>

<template>
  <div>
    <div class= "flex justify-between px-3 py-1">
      <button class="flex"
              @click="onClose"
      >
        <ArrowSmallLeftIcon class="h-6" />
        {{ $t("company_browser.back_to_list") }}
      </button>
      <button class="flex"
              @click="copyUrl"
      >
        <LinkIcon class="h-6" />
        {{ $t("company_browser.copy_link") }}
      </button>
    </div>
    <div
      class="shadow h-full ring-1 ring-black ring-opacity-5 md:rounded-lg overflow-x-hidden overflow-y-scroll"
    >
      <div class="mt-4 p-4 px-10 pt-1 text-left sm:text-left">
        <div>
          <h1 class="text-gray-900 pb-2 text-2xl text-center font-medium">
            {{ company.name }}
          </h1>
          <hr class="border-b border-gray-300">
        </div>
        <p
          class="pt-2 text-gray-600 text-xs sm:text-sm flex items-center justify-center mb-4"
        >
          <img
            class="h-5 w-10 hover:h-6 hover:w-11"
            :src="LocationIcon"
            @click="onZoom"
          >{{ company.location.name }}
        </p>

        <div
          class="flex items-center flex-col mt-5 sm:py-4 gap-2 sm:gap-4 mb-5 "
        >

          <img
            class="aspect-[1/1] max-h-24 ssm:max-h-48 shadow-lg rounded-lg border-2 object-contain"
            :src="'/storage/images/' + company.logo"
          >

          <div
            class="flex flex-col justify-center sm:gap-2 rounded-lg shadow-md p-2 bg-white w-full "
          >

            <p class="flex justify-center font-semibold  ">
              {{ $t("company_browser.contact_details") }}
            </p>
            <div class="truncate flex gap-2 ">
              <EnvelopeIcon class="h-6 w-6 shrink-0" /><a
                class="text-blue-700 font-medium text-ellipsis overflow-hidden"
                :href="'mailto:' + company.contact_details.email"
              >{{ company.contact_details.email }}</a>
            </div>
            <div class="truncate flex gap-2">
              <GlobeAltIcon class="h-6 w-6 shrink-0" />
              <a
                v-if="company.contact_details.website_url"
                class="text-blue-700 font-medium text-ellipsis overflow-hidden"
                :href="company.contact_details.website_url"
                target="_blank"
              >{{ company.contact_details.website_url }}</a>
              <span v-else>{{
                $t("company_browser.information_not_provided")
              }}</span>
            </div>
            <div class="truncate flex gap-2">
              <DevicePhoneMobileIcon class="h-6 w-6 shrink-0" />
              <span class="text-ellipsis overflow-hidden" v-if="company.contact_details.phone_number">{{
                company.contact_details.phone_number
              }}</span>
              <span v-else>{{
                $t("company_browser.information_not_provided")
              }}</span>
            </div>
          </div>
        </div>


        
        <div class="mt-2 rounded-lg p-2 bg-white shadow-md">
          <p class="font-medium">
            {{ $t("company_browser.company_seeks") }}
          </p>
          <ul class="list-decimal list-inside">
            <li
              v-for="specialization in company.specializations"
              :key="specialization.id"
            >
              <InertiaLink
                :href="route('index', { specialization: specialization.id })"
              >
                {{ specialization.label }}
              </InertiaLink>
            </li>
          </ul>
        </div>

        <div class="mt-2 rounded-lg p-2 bg-white shadow-md">
          <p class="font-medium">
            {{ $t("company_browser.description") }}
          </p>
          <MarkdownEditor
            :preview-only="true"
            class="!bg-transparent w-full"
            :model-value="company.description"
          />
        </div>
      </div>
      <div class="flex justify-center mx-auto gap-2 w-3/4 pb-10">
        <div
          v-if="
            company.status === 'pending_new' &&
              $page.props.auth.can.manage_companies
          "
          type="button"
          class="cursor-pointer mt-2 relative w-60 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
          @click="onUpdate"
        >
          {{ $t("company_browser.verify_button") }}
        </div>
        <div
          v-if="
            $page.props.auth.user &&
              (company.owner_id === $page.props.auth.user.id ||
                $page.props.auth.can.manage_companies)
          "
          type="button"
          class="cursor-pointer mt-2 relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
          @click="onDestroy"
        >
          <TrashIcon class="h-6 w-6" />
        </div>
      </div>
    </div>
  </div>
</template>
