import { defineStore } from "pinia";
// import axios from "axios";
// import { useRouter } from 'vue-router'
// import axios from 'axios'

const baseUrl = `${import.meta.env.VITE_API_URL}`;
export const useAuthenticationStore = defineStore("authentication", {
  state: () => ({
    startAjaxLoading: false,
    errorTitle: "",
    errorList: [],
    showError: false,
    loggedIn: localStorage.getItem("loggedIn"),
    userDetail: JSON.parse(localStorage.getItem("userDetail")),
    token: localStorage.getItem("token"),
  }),
  getters: {
    isLoggedIn: (state) => {
      return state.loggedIn;
      // return state.loggedIn;
    },
    getUser: (state) => {
      return JSON.parse(localStorage.getItem("userDetail"));
    },
    getToken: (state) => {
      return localStorage.getItem("token");
    },
  },
  actions: {
    clearErrorState() {
      this.showError = false;
      this.errorList = [];
      this.errorTitle = "[]";
    },
    handleAjaxClientError(response){
      this.startAjaxLoading = false;
      this.showError = true;
      console.log(response);
      if (response.status == 401) {
        this.errorTitle = response.data.message;
      }
      if (response.status == 422) {
        this.errorList = [];
        let objKeys = Object.keys(response.data.errors);
        objKeys.forEach((key) => {
          this.errorList.push(response.data.errors[key]);
        });
      }
    },
    async tryLogin(email, password) {
      // console.log(this.ajaxClient);
      this.clearErrorState();
      this.startAjaxLoading = true;
      await this.ajaxClient
        .post(
          // `${baseUrl}login`,
          "login",
          { email: email, password: password },
          { "Content-Type": "application/json" }
        )
        .then((response) => {
          this.startAjaxLoading = false;
          //console.log(response.data.data);
          localStorage.setItem("token", response.data.data.token);
          const userDetail = JSON.stringify({
            name: response.data.data.name,
            email: response.data.data.email,
          });
          localStorage.setItem("userDetail", userDetail);
          localStorage.setItem("loggedIn", true);
          this.loggedIn = localStorage.getItem("loggedIn");
          // return true;
          // const router = useRouter()
          this.router.push({ name: "Dashboard" });
        })
        .catch((error) => {
          //console.log(error)
          if(error.code == "ERR_NETWORK"){
            this.router.push({ name: "network-issue" });
            this.startAjaxLoading = false;
            return false;
          }
          
          this.handleAjaxClientError(error.response)
        });
    },
    logout() {
      localStorage.removeItem("token");
      localStorage.removeItem("userDetail");
      localStorage.removeItem("loggedIn");
      this.loggedIn = localStorage.getItem("loggedIn");

      this.clearErrorState();
      this.startAjaxLoading = true;
      this.ajaxClient
        .post("logout")
        .then((response) => {
          this.startAjaxLoading = false;
          this.router.push({ name: "login" });
        })
        .catch((error) => {
          this.handleAjaxClientError(error.response);
          this.showError = false;
        });
    },
  },
});
// return useAuthenticationStore;
