import {createRouter, createWebHistory} from "vue-router";
import useUser from "../entities/UserEntity";

const {isLoggedIn} = useUser();

const routes = [
  {
    path: "/",
    name: "home",
    component: () => import("../views/HomeView.vue"),
  },
  {
    path: "/base",
    name: "base",
    component: () => import("../views/BaseView.vue"),
  },
  {
    path: "/login",
    name: "login",
    component: () => import("../views/LoginView.vue"),
  },
  {
    path: "/wallets",
    name: "wallets",
    component: () => import("../views/WalletsView.vue"),
  },
  {
    path: "/transactions",
    name: "transactions",
    component: () => import("../views/TransactionsView.vue"),
  },
  {
    path: "/links",
    name: "links",
    component: () => import("../views/LinksView.vue"),
  },
  {
    path: "/categories",
    name: "categories",
    component: () => import("../views/CategoriesView.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {

  if (isLoggedIn()) {
    if (to.name === 'login') {
      next({name: 'home'});
    } else {
      next();
    }
  }

  if (!isLoggedIn()) {
    if (
      to.name === 'wallets' ||
      to.name === 'transactions' ||
      to.name === 'links'
    ) {
      next({name: 'home'});
    } else {
      next();
    }
  }
});

export default router;
