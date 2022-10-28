import axios from "axios";
const ajaxClient = axios.create({
  baseURL: `${import.meta.env.VITE_API_URL}`, // local server
  headers: {
    "Content-type": "application/json"
  },
});

export default ajaxClient;
