// App imports
import { axiosInstance } from "@/services/core-services/axiosInstance";
import { paths } from "@/types/generated/core-api-schema";
import { ThreadSummaries } from "@/types/core-types";

export class ThreadSummaryService {
  /**
   * Fetch a specific thread by its ID.
   * @param {Threads["Request"]["GetById"]} params - An object containing the thread's ID.
   * @returns {Promise<Threads["Response"]["GetById"]>} - A promise that resolves to the thread data.
   */
  static getById = async (
    params: ThreadSummaries["Request"]["GetById"],
  ): Promise<ThreadSummaries["Response"]["GetById"]> => {
    const endPoint: keyof paths =
      `/api/thread-summaries/${params.id}` as keyof paths;
    return await axiosInstance
      .get<ThreadSummaries["Response"]["GetById"]>(endPoint)
      .then((response) => {
        return response.data;
      });
  };
}
