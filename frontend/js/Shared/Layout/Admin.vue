<script setup>
import SideBar from "@/js/Shared/Components/AdminPanelSideBar.vue";
import { useToast } from "vue-toastification";
import { watch } from "vue";

const props = defineProps({
  flash: Object,
});

const toast = useToast();
watch(
  () => props.flash,
  (flash) => {
    if (flash.success) {
      toast.success(flash.success);
    }
    if (flash.info) {
      toast.info(flash.info);
    }
    if (flash.error) {
      toast.error(flash.error);
    }
  },
  { immediate: true }
);
</script>

<template>
  <div class="h-full overflow-hidden flex">
    <SideBar />
    <slot />
  </div>
</template>
