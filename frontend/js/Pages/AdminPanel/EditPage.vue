<script setup>
import Form from "./Components/EditCompany.vue";
defineProps({
  company: Object,
});
</script>

<template>
  <Form :company="company" />
</template>
