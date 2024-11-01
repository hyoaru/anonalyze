// App imports
import { axiosInstance } from "@/services/core-services/axiosInstance";
import { paths } from "@/types/generated/core-api-schema";
import { Posts } from "@/types/core-types";

export const posts = {

  /**
   * Fetch a specific post by its ID.
   * @param {Posts["Request"]["GetById"]} params - An object containing the post's ID.
   * @returns {Promise<Posts["Response"]["GetById"]>} - A promise that resolves to the post data.
   */
  getById: async (
    params: Posts["Request"]["GetById"],
  ): Promise<Posts["Response"]["GetById"]> => {
    const endPoint: keyof paths = `/api/posts/${params.id}` as keyof paths;
    return await axiosInstance
      .get<Posts["Response"]["GetById"]>(endPoint)
      .then((response) => {
        return response.data;
      });
  },

  /**
   * Fetch a posts by its thread id .
   * @param {Posts["Request"]["GetById"]} params - An object containing the thread id.
   * @returns {Promise<Posts["Response"]["GetById"]>} - A promise that resolves to the list of post data.
   */
  getByThreadId: async (
    params: Posts["Request"]["GetByThreadId"],
  ): Promise<Posts["Response"]["GetByThreadId"]> => {
    const endPoint: keyof paths = `/api/posts/by-thread-id`
    return await axiosInstance
      .post<Posts["Response"]["GetByThreadId"]>(endPoint, params)
      .then((response) => {
        return response.data;
      });
  },

  /**
   * Store a new post.
   * @param {Posts["Request"]["Store"]} params - The parameters required to create a new post.
   * @returns {Promise<Posts["Response"]["Store"]>} - A promise that resolves to the created post data.
   */
  store: async (
    params: Posts["Request"]["Store"],
  ): Promise<Posts["Response"]["Store"]> => {
    const endPoint: keyof paths = "/api/posts";
    const requestBody = params;
    return await axiosInstance
      .post<Posts["Response"]["Store"]>(endPoint, requestBody)
      .then((response) => {
        return response.data;
      });
  },

  /**
   * Delete a specific post by its ID.
   * @param {Posts["Request"]["Destroy"]} params - An object containing the post's ID to delete.
   * @returns {Promise<Posts["Response"]["Destroy"]>} - A promise that resolves to the delete response.
   */
  destroy: async (
    params: Posts["Request"]["Destroy"],
  ): Promise<Posts["Response"]["Destroy"]> => {
    const endPoint: keyof paths = `/api/posts/${params.id}` as keyof paths;
    return await axiosInstance
      .delete<Posts["Response"]["Destroy"]>(endPoint)
      .then((response) => {
        return response.data;
      });
  },
};
