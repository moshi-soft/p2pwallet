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
    userDetail: localStorage.getItem("userDetail"),
    token: localStorage.getItem("token"),
  }),
  getters: {
    isLoggedIn: (state) => {
      return state.loggedIn;
      // return state.loggedIn;
    },
    getUser: (state) => {
      // console.log(state.userDetail)
     //let  abc = JSON.parse(localStorage.getItem("userDetail"));
     try{
      let user = JSON.parse(state.userDetail);
      return user
     }catch($e){

     }
     
    //  console.log(user.name)
    //  return;
      return ;
    },
    getToken: (state) => {
      return state.token;
    },
  },
  actions: {
    updateLoginState(){
      this.token = localStorage.getItem("token");
      this.loggedIn = localStorage.getItem("loggedIn");
      this.userDetail = localStorage.getItem("userDetail");
    },
    clearErrorState() {
      this.showError = false;
      this.errorList = [];
      this.errorTitle = "[]";
    },
    handleAjaxClientError(response){
      this.startAjaxLoading = false;
      this.showError = true;
      //console.log(response);
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
    axiosHeader() {
      return {
        "Content-type": "application/json",
        Authorization: "Bearer " + this.token,
      };
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
          localStorage.setItem("token", response.data.data.token);
          const userDetail = JSON.stringify({
            name: response.data.data.name,
            email: response.data.data.email,
            currency: response.data.data.currency,
          });
          localStorage.setItem("userDetail", userDetail);
          localStorage.setItem("loggedIn", true);
          this.updateLoginState()
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
      this.updateLoginState()

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
