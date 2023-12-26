import {createRouter, createWebHistory} from "vue-router";

const routes = [
  {
    path: "/",
    name: "home",
    component: () => import("../src/views/HomeView.vue"),
  },
  {
    path: "/base",
    name: "base",
    component: () => import("../src/views/BaseView.vue"),
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
