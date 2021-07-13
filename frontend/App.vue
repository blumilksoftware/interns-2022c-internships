<template>
  <div>
    <Landing />
  </div>
</template>

<script>
import Landing from "./views/Landing.vue";

export default {
  name: "App",
  components: {
    Landing,
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
