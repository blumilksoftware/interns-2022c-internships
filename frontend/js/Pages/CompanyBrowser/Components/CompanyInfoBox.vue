<script setup>
defineProps({
  company: Object,
});

const emit = defineEmits(["close"]);
function onClose() {
  emit("close");
}
</script>

<template>
  <div
    class="shadow ring-1 ring-black ring-opacity-5 md:rounded-lg overflow-x-hidden overflow-y-scroll"
  >
    (Company detail placeholder)
  </div>
</template>
