import axios from "axios";
// import {useAuthenticationStore} from '../../store/authentication';

// const store = useAuthenticationStore();
const ajaxClient = axios.create({
  baseURL: `${import.meta.env.VITE_API_URL}`, // local server
  headers: {
    "Content-type": "application/json",
    token: localStorage.getItem('token'),
  },
});

export default ajaxClient;
