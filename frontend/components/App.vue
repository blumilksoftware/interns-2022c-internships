<template>
  <div class="h-full flex flex-col">
    <NavigationBar />
    <component :is="currentView" />
  </div>
</template>

<script setup>
import NavigationBar from "@/components/NavigationBar.vue";
import { ref, computed } from "vue";
import Home from "@/views/HomePage.vue";
import SignIn from "@/views/SignInPage.vue";
import Registration from "@/views/RegistrationPage.vue";
import AddCompany from "@/views/AddCompanyPage.vue";
import NotFound from "@/views/NotFoundPage.vue";
import ForgotPassword from "@/views/ForgotPasswordPage.vue";

const routes = {
  "/": Home,
  "/signin": SignIn,
  "/registration": Registration,
  "/addcompany": AddCompany,
  "/forgotpassword": ForgotPassword,
};
const currentPath = ref(window.location.hash);
window.addEventListener("hashchange", () => {
  currentPath.value = window.location.hash;
});
const currentView = computed(() => {
  return routes[currentPath.value.slice(1) || "/"] || NotFound;
});
</script>
