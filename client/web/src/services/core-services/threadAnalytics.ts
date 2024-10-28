// App imports
import { axiosInstance } from "@/services/core-services/axiosInstance";
import { paths } from "@/types/generated/core-api-schema";
import { ThreadAnalytics } from "@/types/core-types";

export const threadAnalytics = {
  /**
   * Fetch a specific thread analytics by its ID.
   * @param {ThreadAnalytics["Request"]["GetById"]} params - An object containing the threadAnalytic's ID.
   * @returns {Promise<ThreadAnalytics["Response"]["GetById"]>} - A promise that resolves to the threadAnalytic data.
   */
  getById: async (
    params: ThreadAnalytics["Request"]["GetById"],
  ): Promise<ThreadAnalytics["Response"]["GetById"]> => {
    const endPoint: keyof paths = `/api/threadAnalytics/${params.id}` as keyof paths;
    return await axiosInstance
      .get<ThreadAnalytics["Response"]["GetById"]>(endPoint)
      .then((response) => {
        return response.data;
      });
  },

  /**
   * Delete a specific thread analytics by its ID.
   * @param {ThreadAnalytics["Request"]["Destroy"]} params - An object containing the thread analytics' ID to delete.
   * @returns {Promise<ThreadAnalytics["Response"]["Destroy"]>} - A promise that resolves to the delete response.
   */
  destroy: async (
    params: ThreadAnalytics["Request"]["Destroy"],
  ): Promise<ThreadAnalytics["Response"]["Destroy"]> => {
    const endPoint: keyof paths = `/api/threadAnalytics/${params.id}` as keyof paths;
    return await axiosInstance
      .delete<ThreadAnalytics["Response"]["Destroy"]>(endPoint)
      .then((response) => {
        return response.data;
      });
  },

  /**
   * Fetch a specific thread analytic metrics by its ID.
   * @param {ThreadAnalytics["Request"]["GetById"]} params - An object containing the thread's ID.
   * @returns {Promise<ThreadAnalytics["Response"]["GetById"]>} - A promise that resolves to the thread analytic metrics data.
   */
  getThreadAnalyticMetrics: async (
    params: ThreadAnalytics["Request"]["GetThreadAnalyticMetrics"],
  ): Promise<ThreadAnalytics["Response"]["GetThreadAnalyticMetrics"]> => {
    const endPoint: keyof paths = `/api/threads/${params.id}/thread-analytics/metrics` as keyof paths;
    return await axiosInstance
      .get<ThreadAnalytics["Response"]["GetThreadAnalyticMetrics"]>(endPoint)
      .then((response) => {
        return response.data;
      });
  },
};
