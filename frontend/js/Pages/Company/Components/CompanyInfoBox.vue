<script setup>
import LocationIcon from "@/assets/icons/locationIcon.svg";
import { onMounted } from "vue";
import { XIcon } from "@heroicons/vue/outline";
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
        <XIcon class="pr-5 pt-5 h-12 w-12 text-gray-700" />
      </button>
    </div>
    <div
      class="shadow h-full ring-1 ring-black ring-opacity-5 md:rounded-lg overflow-x-hidden overflow-y-scroll"
    >
      <div class="flex justify-center mt-5 px-10">
        <img
          class="h-20 w-20 sm:h-40 sm:w-40 shadow-lg rounded-lg border-2"
          :src="'/storage/images/' + company.logo"
          alt=""
        />
      </div>

      <div class="p-4 px-10 pt-1 md:p-12 text-left lg:text-left">
        <div>
          <h1 class="text-gray-900 pb-2 text-xl">{{ company.name }}</h1>
          <hr class="border-b border-gray-400" />
        </div>
        <p
          class="pt-2 text-gray-600 text-xs lg:text-sm flex items-center justify-center lg:justify-start"
        >
          <img
            class="h-5 w-10 hover:h-6 hover:w-11"
            :src="LocationIcon"
            @click="onZoom"
          />{{ company.location.name }}
        </p>
        <MarkdownEditor
          :previewOnly="true"
          class="!bg-transparent w-full py-5"
          :modelValue="company.description"
        />
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
          @click="onDestroy(company.id)"
          class="cursor-pointer mt-2 relative w-60 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
        >
          {{ $t("company_browser.delete_button") }}
        </div>
      </div>
    </div>
  </div>
</template>
