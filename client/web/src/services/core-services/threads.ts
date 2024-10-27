// App imports
import { axiosInstance } from "@/services/core-services/axiosInstance";
import { paths } from "@/types/generated/core-api-schema";
import { Threads } from "@/types/core-types";

export const threads = {
  /**
   * Fetch all threads created by the authenticated user.
   * @returns {Promise<Threads["Response"]["GetAllByAuthenticatedUser"]>} - A promise that resolves to the user's threads.
   */
  getAllByAuthenticatedUser: async (): Promise<
    Threads["Response"]["GetAllByAuthenticatedUser"]
  > => {
    const endPoint: keyof paths = "/api/threads";
    return await axiosInstance
      .get<Threads["Response"]["GetAllByAuthenticatedUser"]>(endPoint)
      .then((response) => {
        return response.data;
      });
  },

  /**
   * Fetch a specific thread by its ID.
   * @param {Threads["Request"]["GetById"]} params - An object containing the thread's ID.
   * @returns {Promise<Threads["Response"]["GetById"]>} - A promise that resolves to the thread data.
   */
  getById: async (
    params: Threads["Request"]["GetById"],
  ): Promise<Threads["Response"]["GetById"]> => {
    const endPoint: keyof paths = `/api/threads/${params.id}` as keyof paths;
    return await axiosInstance
      .get<Threads["Response"]["GetById"]>(endPoint)
      .then((response) => {
        return response.data;
      });
  },

  /**
   * Store a new thread.
   * @param {Threads["Request"]["Store"]} params - The parameters required to create a new thread.
   * @returns {Promise<Threads["Response"]["Store"]>} - A promise that resolves to the created thread data.
   */
  store: async (
    params: Threads["Request"]["Store"],
  ): Promise<Threads["Response"]["Store"]> => {
    const endPoint: keyof paths = "/api/threads";
    const requestBody = params;
    return await axiosInstance
      .post<Threads["Response"]["Store"]>(endPoint, requestBody)
      .then((response) => {
        return response.data;
      });
  },

  /**
   * Update a specific thread by its ID.
   * @param {Threads["Request"]["Update"]} params - An object containing the thread's ID and updated data.
   * @returns {Promise<Threads["Response"]["Update"]>} - A promise that resolves to the updated thread data.
   */
  update: async (
    params: Threads["Request"]["Update"],
  ): Promise<Threads["Response"]["Update"]> => {
    const endPoint: keyof paths = `/api/threads/${params.id}` as keyof paths;
    const requestBody = { question: params.question };
    return await axiosInstance
      .put<Threads["Response"]["Update"]>(endPoint, requestBody)
      .then((response) => {
        return response.data;
      });
  },

  /**
   * Delete a specific thread by its ID.
   * @param {Threads["Request"]["Destroy"]} params - An object containing the thread's ID to delete.
   * @returns {Promise<Threads["Response"]["Destroy"]>} - A promise that resolves to the delete response.
   */
  destroy: async (
    params: Threads["Request"]["Destroy"],
  ): Promise<Threads["Response"]["Destroy"]> => {
    const endPoint: keyof paths = `/api/threads/${params.id}` as keyof paths;
    return await axiosInstance
      .delete<Threads["Response"]["Destroy"]>(endPoint)
      .then((response) => {
        return response.data;
      });
  },
};
