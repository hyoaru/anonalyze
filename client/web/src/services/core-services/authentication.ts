// App imports
import { axiosInstance } from "@/services/core-services/axiosInstance";
import { Authentication } from "@/types/core-types";
import { paths } from "@/types/generated/core-api-schema";

/**
 * Authentication service to handle user authentication and account management.
 */
export const authentication = {
  /**
   * Sign in a user.
   * @param {Authentication["Request"]["SignIn"]} params - The sign-in parameters.
   * @returns {Promise<Authentication["Response"]["SignIn"]>} The sign-in response containing user data and token.
   */
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
  /**
   * Sign up a new user.
   * @param {Authentication["Request"]["SignUp"]} params - The sign-up parameters.
   * @returns {Promise<Authentication["Response"]["SignUp"]>} The sign-up response containing user data.
   */
  signUp: async (
    params: Authentication["Request"]["SignUp"],
  ): Promise<Authentication["Response"]["SignUp"]> => {
    const endPoint: keyof paths = "/api/auth/sign-up";
    const requestBody = params;
    return await axiosInstance
      .post<Authentication["Response"]["SignUp"]>(endPoint, requestBody)
      .then((response) => {
        const token = response.data.token;
        localStorage.setItem("token", token);
        return response.data;
      });
  },
  /**
   * Sign out the authenticated user.
   * @returns {Promise<Authentication["Response"]["SignOut"]>} The sign-out response.
   */
  signOut: async (): Promise<Authentication["Response"]["SignOut"]> => {
    const endPoint: keyof paths = "/api/auth/sign-out";
    return await axiosInstance
      .post<Authentication["Response"]["SignOut"]>(endPoint)
      .then((response) => {
        localStorage.removeItem("token"); 
        return response.data;
      });
  },
  /**
   * Get the authenticated user's information.
   * @returns {Promise<Authentication["Response"]["GetAuthenticatedUser"]>} The authenticated user's data.
   */
  getAuthenticatedUser: async (): Promise<
    Authentication["Response"]["GetAuthenticatedUser"]
  > => {
    const endPoint: keyof paths = "/api/account";

    const response = await axiosInstance.get(endPoint);
    return response.data;
  },
};
