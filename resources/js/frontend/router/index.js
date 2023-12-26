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
  },
  {
    path: "/login",
    name: "login",
    component: () => import("../src/views/LoginView.vue"),
  },
  {
    path: "/wallets",
    name: "wallets",
    component: () => import("../src/views/WalletsView.vue"),
  },
  {
    path: "/transactions",
    name: "transactions",
    component: () => import("../src/views/TransactionsView.vue"),
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
