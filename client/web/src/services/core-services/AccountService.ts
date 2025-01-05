import { axiosInstance } from "@/services/core-services/axiosInstance";
import { Account } from "@/types/core-types";
import { paths } from "@/types/generated/core-api-schema";

/**
 * Account service to handle user account.
 */
export class AccountService {
  /**
   * Updates user information.
   * @param {Account["Request"]["UpdateInformation"]}
   * @returns {Promise<Account["Response"]["UpdateInformation"]>}
   */
  static updateInformation = async (
    params: Account["Request"]["UpdateInformation"],
  ): Promise<Account["Response"]["UpdateInformation"]> => {
    const endPoint: keyof paths = "/api/account/update-information";
    const requestBody = params;
    return await axiosInstance
      .post<Account["Response"]["UpdateInformation"]>(endPoint, requestBody)
      .then((response) => {
        return response.data;
      });
  };

  /**
   * Updates user email.
   * @param {Account["Request"]["UpdateEmail"]} params
   * @returns {Promise<Account["Response"]["UpdateEmail"]>}
   */
  static updateEmail = async (
    params: Account["Request"]["UpdateEmail"],
  ): Promise<Account["Response"]["UpdateEmail"]> => {
    const endPoint: keyof paths = "/api/account/update-email";
    const requestBody = params;
    return await axiosInstance
      .post<Account["Response"]["UpdateEmail"]>(endPoint, requestBody)
      .then((response) => {
        return response.data;
      });
  };

  /**
   * Updates user password.
   * @param {Account["Request"]["UpdatePassword"]} params
   * @returns {Promise<Account["Response"]["UpdatePassword"]>}
   */
  static updatePassword = async (
    params: Account["Request"]["UpdatePassword"],
  ): Promise<Account["Response"]["UpdatePassword"]> => {
    const endPoint: keyof paths = "/api/account/update-password";
    const requestBody = params;
    return await axiosInstance
      .post<Account["Response"]["UpdatePassword"]>(endPoint, requestBody)
      .then((response) => {
        return response.data;
      });
  };
}
