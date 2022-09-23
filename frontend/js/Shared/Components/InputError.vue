<script setup>
defineProps(["message"]);
</script>

<template>
  <div v-if="message" v-show="message">
    <p class="text-sm mt-2 text-red-600">
      {{ $t(message) }}
    </p>
  </div>
</template>
