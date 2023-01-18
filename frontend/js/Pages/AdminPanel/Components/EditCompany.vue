<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "@/js/Shared/Components/InputError.vue";
import { ref, onMounted } from "vue";
import MapGeocode from "./EditCompanyMap.vue";
import "@tkmam1x/vue3-treeselect/dist/vue3-treeselect.css";

const form = useForm({
  _method: "put",
  name: props.company.name,
  description: props.company.description,
  address: {
    street: props.company.address.street,
    city: props.company.address.city,
    postal_code: props.company.address.postal_code,
    voivodeship: props.company.address.voivodeship,
    country: props.company.address.country,
    coordinates: {
      latitude: props.company.address.coordinates.latitude,
      longitude: props.company.address.coordinates.longitude,
    },
  },
  contact_details: {
    email: props.company.contact_details.email,
    website_url: props.company.contact_details.website_url,
    phone_number: props.company.contact_details.phone_number,
  },
});
const props = defineProps({
  company: Object,
});

const submit = () => {
  form.address.coordinates = getCoordinatesFromMap();
  form.put(route("admin-companies-store", props.company.id), {});
};
let map = ref();

function generateCoordinates() {
  map.value.onMapLoaded([
    props.company.address.coordinates.longitude,
    props.company.address.coordinates.latitude,
  ]);
}

function getCoordinatesFromMap() {
  let coords = map.value.getCoordinates();

  return {
    latitude: coords.lat,
    longitude: coords.lng,
  };
}
onMounted(() => {
  generateCoordinates();
});
</script>

<template>
  <form @submit.prevent="submit">
    <div class="flex h-full w-full items-center justify-center mt-1">
      <div
        class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2"
      >
        <div class="flex justify-center">
          <div class="flex">
            <h1 class="text-gray-600 pt-2 font-bold md:text-2xl text-xl">
              {{ $t("admin_panel.edit") }}
            </h1>
          </div>
        </div>
        <div class="flex justify-center">
          <div class="pl-0 lg:pl-5 h-96 w-full lg:w-full">
            <MapGeocode ref="map" class="rounded-lg flex" />
          </div>
        </div>
        <div class="grid grid-cols-1 mt-5 mx-7">
          <label
            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
            >{{ $t("add_company.company_name") }}</label
          >
          <input
            required
            type="text"
            v-model="form.name"
            name="name"
            id="name"
            autocomplete="username"
            class="py-2 px-3 rounded-lg border-2 border-slate-400 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
          />
          <InputError class="mt-2" :message="form.errors.name" />
        </div>
        <div class="grid grid-cols-1 mt-5 mx-7">
          <label
            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
            >{{ $t("add_company.description") }}</label
          >
          <textarea
            id="description"
            name="description"
            v-model="form.description"
            rows="3"
            class="py-2 px-3 rounded-lg border-2 border-slate-400 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
          />
          <InputError class="mt-2" :message="form.errors.description" />
        </div>
        <div class="grid grid-cols-1 mt-5 mx-7">
          <label
            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
            >{{ $t("common_labels.email") }}</label
          >
          <input
            required
            id="description"
            name="description"
            v-model="form.contact_details.email"
            class="py-2 px-3 rounded-lg border-2 border-slate-400 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
          />
          <InputError class="mt-2" :message="form.errors.contact_details" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
          <div class="grid grid-cols-1">
            <label
              class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
            >
              {{ $t("add_company.street_address") }}</label
            >
            <input
              required
              type="text"
              name="street-address"
              id="street-address"
              v-model="form.address.street"
              autocomplete="street-address"
              class="py-2 px-3 rounded-lg border-2 border-slate-400 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
            />
          </div>
          <div class="grid grid-cols-1">
            <label
              class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
            >
              {{ $t("add_company.city") }}</label
            >
            <input
              required
              type="text"
              name="city"
              id="city"
              v-model="form.address.city"
              autocomplete="address-level2"
              class="py-2 px-3 rounded-lg border-2 border-slate-400 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
            />
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
          <div class="grid grid-cols-1">
            <label
              class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
            >
              {{ $t("add_company.voivodeship") }}</label
            >
            <input
              required
              type="text"
              name="region"
              id="region"
              v-model="form.address.voivodeship"
              autocomplete="address-level1"
              class="py-2 px-3 rounded-lg border-2 border-slate-400 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
            />
          </div>
          <div class="grid grid-cols-1">
            <label
              class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
            >
              {{ $t("add_company.postal_code") }}</label
            >
            <input
              required
              type="text"
              name="postal-code"
              id="postal-code"
              v-model="form.address.postal_code"
              autocomplete="postal-code"
              class="py-2 px-3 rounded-lg border-2 border-slate-400 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
            />
          </div>
        </div>
        <div class="flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5">
          <inertialink href="/admin/companies">
            <button
              class="w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2"
            >
              {{ $t("buttons.cancel_button") }}
            </button>
          </inertialink>
          <button
            type="submit"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            class="w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2"
          >
            {{ $t("buttons.save_button") }}
          </button>
        </div>
      </div>
    </div>
  </form>
</template>
