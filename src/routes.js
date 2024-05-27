import { createWebHashHistory, createRouter } from "vue-router";
import App from "./App.vue";
import HelloWorld from "./components/HelloWorld.vue";
import Register from "./components/Register.vue";
import HomePage from "./components/HomePage.vue";
import Product from "./components/Product.vue";
const routes = [
  {
    path: "/",
    component: App,
  },
  {
    path: "/home",
    component: HomePage,
  },
  {
    path: "/section-one",
    component: HomePage,
  },
  {
    path: "/logout",
    component: HomePage,
  },
  {
    path: "/login",
    component: HelloWorld,
  },
  {
    path: "/register",
    component: Register,
  },
  {
    path: "/product",
    component: Product,
  },
];
const router = createRouter({
  history: createWebHashHistory(),
  routes,
});
export default router;
