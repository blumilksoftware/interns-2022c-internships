<script setup>
import MapGeocode from "./Components/MapGeocode.vue";
import MarkdownEditor from "@/js/Shared/Components/MarkdownEditor.vue";
import Treeselect from "@tkmam1x/vue3-treeselect";
import "@tkmam1x/vue3-treeselect/dist/vue3-treeselect.css";

import {
  MapPinIcon,
  BuildingOffice2Icon,
  PencilSquareIcon,
} from "@heroicons/vue/24/solid";
</script>
<template>
  <div class="flex justify-center">
    <div class="w-full md:w-4/6 p-6">
      <!-- step bar -->
      <div class="flex items-center flex-col-reverse gap-3 xl:flex-row pb-10">
        <div class="flex flex-col gap-4 flex-1">
          <h1 class="text-4xl font-semibold text-primary">
            Uzupełnij podstawowe dane firmy
          </h1>
          <h4 class="text-md">
            Uzupełnij nazwę swojej firmy, e-mail do kontaktu, numer telefonu
            oraz stronę internetową. Dla identyfikacji firmy, warto również
            dodać logo.
          </h4>
        </div>
        <div class="flex gap-3 flex-1 justify-end">
          <div
            class="h-20 w-fit px-3 border-2 border-primary rounded-xl flex items-center justify-center gap-2"
          >
            <BuildingOffice2Icon class="h-12 w-12 p-2 bg-gray-200 rounded-xl" />
            <div class="flex flex-col">
              <span class="text-xs font-semibold text-primary">Krok 1/3</span>
              <strong>Podstawowe informacje</strong>
            </div>
          </div>
          <div
            class="h-20 w-20 border-2 border-gray-400 rounded-xl flex items-center justify-center"
          >
            <MapPinIcon class="h-12 w-12 p-2 bg-gray-200 rounded-xl" />
          </div>
          <div
            class="h-20 w-20 border-2 border-gray-400 rounded-xl flex items-center justify-center"
          >
            <PencilSquareIcon class="h-12 w-12 p-2 bg-gray-200 rounded-xl" />
          </div>
        </div>
      </div>

      <!-- sekcja 1 -->
      <div class="flex justify-center items-center gap-8 flex-col md:flex-row">
        <div
          class="border border-black aspect-[1/1] rounded-xl w-full max-w-[250px] ssm:w-80"
        >
          test
        </div>
        <div class="flex flex-col gap-3 w-full ssm:w-80">
          <FormKit
            type="text"
            label="Nazwa firmy"
            placeholder="Wprowadź nazwę firmy"
          />
          <FormKit
            type="text"
            label="E-mail firmowy"
            placeholder="Wprowadź e-mail do kontaktu"
          />
          <FormKit
            type="text"
            label="Numer telefonu"
            placeholder="Na przykład: 123-456-789"
          />
          <FormKit
            type="text"
            label="Strona internetowa"
            placeholder="Na przykład: https://example.com"
          />
        </div>
      </div>

      <!-- sekcja 2 -->
      <div
        class="flex justify-center items-center gap-8 flex-col-reverse md:flex-row"
      >
        <div class="flex flex-col gap-3 w-full ssm:w-80">
          <FormKit type="text" label="Kraj" />
          <FormKit type="text" label="Województwo" />
          <FormKit type="text" label="Miasto" />
          <FormKit type="text" label="Kod pocztowy" />
          <FormKit type="text" label="Ulica" />
        </div>
        <div class="border aspect-[1/1] rounded-xl w-full ssm:w-80">
          <MapGeocode ref="map" class="rounded-lg" />
        </div>
      </div>

      <!-- sekcja 3 -->
      <div class="flex justify-center items-center flex-col md:flex-row">
        <MarkdownEditor
          :preview="false"
          class="!h-64 md:!h-96 !w-full max-w-lg"
          v-model="test"
        />
        <MarkdownEditor
          :previewOnly="true"
          class="!h-64 md:!h-96 !w-full !p-5 max-w-lg"
          v-model="test"
        />
      </div>
    </div>
  </div>
</template>
