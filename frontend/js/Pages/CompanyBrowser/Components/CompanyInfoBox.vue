<script setup>
import LocationIcon from "@/assets/icons/locationIcon.svg";

defineProps({
  company: Object,
});

const emit = defineEmits(["close", "destroy", "update"]);
function onClose() {
  emit("close");
}
function onDestroy() {
  emit("destroy")
}
function onUpdate() {
  emit("update")
}

</script>

<template>
  <div class="sticky h-0 right-10 w-full flex justify-end">
    <button class="sticky right-0" @click="onClose">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="fill-current text-gray-700"
        viewBox="0 0 16 16"
        width="40"
        height="40"
      >
        <path
          fill-rule="evenodd"
          d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z"
        ></path>
      </svg>
    </button>
  </div>
  <div
    class="shadow h-full ring-1 ring-black ring-opacity-5 md:rounded-lg overflow-x-hidden overflow-y-scroll"
  >
    <div class="flex justify-center mt-5 px-10">
      <img
        class="h-20 w-20 sm:h-40 sm:w-40 rounded-lg border-2"
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
        <img class="h-5 w-10" :src="LocationIcon" />{{
          company.location.name
        }}
      </p>
      <blockquote class="border-l-4 border-blue-500 italic my-8 pl-8 md:pl-8">
        {{ company.description }}
      </blockquote>
    </div>
    <div class="justify-center mx-auto gap-2 flex w-3/4">
    <div type="button" @click="onUpdate" v-if="company.status === 'pending_new'" class="w-1/2 flex justify-center p-0 bg-green-600 border rounded-3xl border-stone-900 text-white hover:bg-green-900">Approve</div>
      <div type="button" @click="onDestroy(company.id)" class="justify-center flex w-1/2 p-0 bg-red-600 border rounded-3xl border-stone-900 text-white hover:bg-red-900">Delete</div>
   </div>
  </div>
</template>
