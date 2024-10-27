import axios from "axios";

const CORE_API_URL = import.meta.env.VITE_CORE_API_URL;

export const axiosInstance = axios.create({
  baseURL: CORE_API_URL,
  headers: {
    Accept: "application/json",
  },
});

axiosInstance.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem("token");
    if (token) {
      config.headers["Authorization"] = `Bearer ${token}`;
    }
    return config;
  },
  (e) => {
    console.log(`error ${e}`);
  },
);