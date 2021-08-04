<template>
  <button>
    <i v-if="hasIcon" :class="icon"></i>
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    hasIcon: Boolean,
    icon: String,
  },
};
</script>
