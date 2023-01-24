<script setup>
import { computed } from "vue"

const props = defineProps({
  links: Array,
  routeName: String,
})

const previous = computed({
  get() {
    return props.links[0]
  },
})

const next = computed({
  get() {
    return props.links[props.links.length - 1]
  },
})

function getUrl(url){
  let linkUrl = new URL(url)
  let params = linkUrl.searchParams
  let queryString = ""
  params.forEach((value, key) => {
    queryString += `&${key}=${value}`
  })

  return route(props.routeName) + "?" + queryString.substring(1)
}
</script>

<template>
  <div v-if="links.length > 3">
    <div class="flex flex-column w-full mb-auto">
      <template
        v-for="(link, p) in [previous, next]"
        :key="p"
      >
        <div
          v-if="link.url === null"
          class="w-full mr-1 mb-1 px-4 py-3 text-center text-sm leading-4 text-gray-400 border rounded"
        >
          {{ $t(link.label) }}
        </div>
        <InertiaLink
          v-else
          preserve-state
          class="w-full mr-1 mb-1 px-4 py-3 text-center text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
          :class="{ 'bg-blue-700 text-white': link.active }"
          :href="getUrl(link.url)"
        >
          {{ $t(link.label) }}
        </InertiaLink>
      </template>
    </div>
  </div>
</template>
