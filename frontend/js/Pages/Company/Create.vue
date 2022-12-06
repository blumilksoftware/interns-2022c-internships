<script setup>
import MapGeocode from "./Components/MapGeocode.vue";
import MarkdownEditor from "@/js/Shared/Components/MarkdownEditor.vue";
import Treeselect from "@tkmam1x/vue3-treeselect";
import "@tkmam1x/vue3-treeselect/dist/vue3-treeselect.css";
</script>
<template>
  <div class="flex justify-center items-center gap-8 p-6 flex-col md:flex-row">
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
    class="flex justify-center items-center gap-8 p-6 flex-col-reverse md:flex-row"
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
  <div class="flex justify-center items-center p-6 flex-col md:flex-row">
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
</template>
