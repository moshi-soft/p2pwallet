import { createRouter, createWebHistory } from "vue-router";
// import Home from '../views/Home.vue'
import Login from "../views/Login.vue";
import Dashboard from "../views/Dashboard.vue";
import Payment from "../views/Payment.vue";
import PaymentSuccess from "../views/PaymentSuccess.vue";
// import TransactionHistory from "../views/TransactionHistory.vue";

import NotFound from "../views/NotFound.vue";
import NetworkIssue from "../views/NetworkIssue.vue";
// import NetworkIssue from '../views/NetworkIssue.vue'

const routes = [
  {
    path: "/",
    name: "Dashboard",
    component: Dashboard,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: "/login",
    name: "login",
    component: Login,
  },
  {
    path: "/payment",
    name: "Payment",
    component: Payment,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: "/payment-success",
    name: "PaymentSuccess",
    component: PaymentSuccess,
    meta: {
      requiresAuth: true,
    },
  },
  // {
  //   path: "/transaction-history",
  //   name: "TransactionHistory",
  //   component: TransactionHistory,
  //   // meta:{
  //   //   requiresAuth:true
  //   // },
  // },
  {
    path: "/404",
    name: "404",
    component: NotFound,
    props: true,
  },
    {
      path:'/network-issue',
      name:'network-issue',
      component:NetworkIssue
    },
  {
    path: "/:catchAll(.*)*",
    redirect: { name: "404", params: { resource: "views" } },
    // redirect: () => {
    //   return { path: '/404' }
    //   // the function receives the target route as the argument
    //   // return redirect path/location here.
    // },
    meta: {
      requiresAuth: false,
    },
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
   // console.log('TO:',to);
  const loggedIn = localStorage.getItem("loggedIn");
  if (to.matched.some((record) => record.meta.requiresAuth && !loggedIn)) {
    next("/login");
  } else if(to.name == 'login' && loggedIn) {
    next("/");
  }else {
    next();
  }
});

export default router;
