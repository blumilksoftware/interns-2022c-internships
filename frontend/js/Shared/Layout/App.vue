<script setup>
import NavigationBar from "@/js/Shared/Components/NavigationBar.vue"
import { useToast } from "vue-toastification"
import { watch } from "vue"
import { useI18n } from "vue-i18n"

const i18n = useI18n()

const props = defineProps({
  flash: Object,
})

const toast = useToast()
watch(
  () => props.flash,
  (flash) => {
    if (flash.success) {
      toast.success(i18n.t(flash.success))
    }
    if (flash.info) {
      toast.info(i18n.t(flash.info))
    }
    if (flash.error) {
      toast.error(i18n.t(flash.error))
    }
  },
  { immediate: true },
)
</script>

<template>
  <div class="h-full flex flex-col">
    <NavigationBar />
    <slot />
  </div>
</template>
