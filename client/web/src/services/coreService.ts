import axios from "axios";

// App imports
import { Authentication } from "@/types/core-types";
import { paths } from "@/types/generated/core-api-schema";

const CORE_API_URL = process.env.CORE_API_URL;

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
  () => {},
);

export const coreService = {
  authentication: {
    signIn: async (
      params: Authentication["Request"]["SignIn"],
    ): Promise<Authentication["Response"]["SignIn"]> => {
      const endPoint: keyof paths = "/api/auth/sign-in";
      const requestBody = params;
      return (await axiosInstance.post(endPoint, requestBody)).data;
    },
    signUp: async (
      params: Authentication["Request"]["SignUp"],
    ): Promise<Authentication["Response"]["SignUp"]> => {
      const endPoint: keyof paths = "/api/auth/sign-up";
      const requestBody = params;
      return (await axiosInstance.post(endPoint, requestBody)).data;
    },
    signOut: async (
      params: Authentication["Request"]["SignOut"],
    ): Promise<Authentication["Response"]["SignOut"]> => {
      const endPoint: keyof paths = "/api/auth/sign-out";
      const requestBody = params;
      return (await axiosInstance.post(endPoint, requestBody)).data;
    },
    getAuthenticatedUser: async (
      params: Authentication["Request"]["GetAuthenticatedUser"],
    ): Promise<Authentication["Response"]["GetAuthenticatedUser"]> => {
      const endPoint: keyof paths = "/api/account";
      const requestBody = params;
      return (await axiosInstance.get(endPoint, requestBody)).data;
    },
  },
};
