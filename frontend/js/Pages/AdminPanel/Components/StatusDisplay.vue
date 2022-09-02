<script setup>
const props= defineProps({
    status: String,
})
</script>

<template>
                    <span
                    v-if="props.status === 'verified'"
                      class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800"
                      >Verified</span
                    >
                    <span
                    v-else-if="props.status === 'pending_new'"
                      class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-500"
                      >New</span
                    >
                    <span
                    v-else-if="props.status === 'pending_edited'"
                      class="inline-flex rounded-full bg-blue-100 px-2 text-xs font-semibold leading-5 text-blue-800"
                      >Edited</span
                    >
                    
</template>