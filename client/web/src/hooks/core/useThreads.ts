import { CoreService } from "@/services/CoreService";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

export default function useThreads() {
  const queryClient = useQueryClient();

  /* eslint-disable react-hooks/rules-of-hooks */
  const getAllByAuthenticatedUserQuery = () =>
    useQuery({
      queryFn: CoreService.thread.getAllByAuthenticatedUser,
      queryKey: ["threads", "authenticated_user"],
    });

  const getByIdQuery = (
    params: Parameters<typeof CoreService.thread.getById>[0],
  ) =>
    useQuery({
      queryFn: () => CoreService.thread.getById(params),
      queryKey: ["threads", { id: params.id }],
    });

  /* eslint-enable react-hooks/rules-of-hooks */

  const storeMutation = useMutation({
    mutationFn: (params: Parameters<typeof CoreService.thread.store>[0]) =>
      CoreService.thread.store(params),
    onSuccess: () => {
      [["threads"], ["threads", "authenticated_user"]].forEach((queryKey) => {
        queryClient.invalidateQueries({
          queryKey: queryKey,
          refetchType: "all",
        });
      });
    },
  });

  const updateMutation = useMutation({
    mutationFn: (params: Parameters<typeof CoreService.thread.update>[0]) =>
      CoreService.thread.update(params),
    onSuccess: (response) => {
      [
        ["threads"],
        ["threads", "authenticated_user"],
        ["threads", { id: response.id }],
      ].forEach((queryKey) => {
        queryClient.invalidateQueries({
          queryKey: queryKey,
          refetchType: "all",
        });
      });
    },
  });

  const destroyMutation = useMutation({
    mutationFn: (params: Parameters<typeof CoreService.thread.destroy>[0]) =>
      CoreService.thread.destroy(params),
    onSuccess: (response) => {
      [
        ["threads"],
        ["threads", "authenticated_user"],
        ["threads", { id: response.id }],
      ].forEach((queryKey) => {
        queryClient.invalidateQueries({
          queryKey: queryKey,
          refetchType: "all",
        });
      });
    },
  });

  return {
    getAllByAuthenticatedUserQuery,
    getByIdQuery,
    storeMutation,
    updateMutation,
    destroyMutation,
  };
}
