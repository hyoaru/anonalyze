import axios from "axios";

// App imports
import { Authentication } from "@/types/core-types";
import { paths } from "@/types/generated/core-api-schema";

const CORE_API_URL = import.meta.env.VITE_CORE_API_URL;

const axiosInstance = axios.create({
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

export const coreService = {
  authentication: {
    signIn: async (
      params: Authentication["Request"]["SignIn"],
    ): Promise<Authentication["Response"]["SignIn"]> => {
      const endPoint: keyof paths = "/api/auth/sign-in";
      const requestBody = params;
      return await axiosInstance
        .post<Authentication["Response"]["SignIn"]>(endPoint, requestBody)
        .then((response) => {
          const token = response.data.token;
          localStorage.setItem("token", token);
          return response.data;
        });
    },
    signUp: async (
      params: Authentication["Request"]["SignUp"],
    ): Promise<Authentication["Response"]["SignUp"]> => {
      const endPoint: keyof paths = "/api/auth/sign-up";
      const requestBody = params;
      return (await axiosInstance.post(endPoint, requestBody)).data;
    },
    signOut: async (): Promise<Authentication["Response"]["SignOut"]> => {
      const endPoint: keyof paths = "/api/auth/sign-out";
      return (await axiosInstance.post(endPoint)).data;
    },
    getAuthenticatedUser: async (): Promise<
      Authentication["Response"]["GetAuthenticatedUser"]
    > => {
      const endPoint: keyof paths = "/api/account";

      const response = await axiosInstance.get(endPoint);
      console.log("fetched");
      console.log(response);
      return response.data;
    },
  },
};
