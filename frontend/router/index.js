import { createRouter, createWebHashHistory } from "vue-router";

const routes = [
  {
    path: "/",
    name: "Landing",
    component: () => import("@/views/LandingPage.vue"),
  },
  {
    path: "/home",
    name: "Home",
    component: () => import("@/views/HomePage.vue"),
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
