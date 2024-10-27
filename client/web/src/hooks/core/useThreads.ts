import { coreService } from "@/services/coreService";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

export default function useThreads() {
  const queryClient = useQueryClient();

  const getAllByAuthenticatedUserQuery = () =>
    useQuery({
      queryFn: coreService.threads.getAllByAuthenticatedUser,
      queryKey: ["threads", "authenticated_user"],
    });

  const getByIdQuery = (
    params: Parameters<typeof coreService.threads.getById>[0],
  ) =>
    useQuery({
      queryFn: () => coreService.threads.getById(params),
      queryKey: ["threads", "authenticated_user"],
    });

  const storeMutation = useMutation({
    mutationFn: (params: Parameters<typeof coreService.threads.store>[0]) =>
      coreService.threads.store(params),
    onSuccess: () => {
      [["threads", "authenticated_user"]].forEach((queryKey) => {
        queryClient.invalidateQueries({
          queryKey: queryKey,
          refetchType: "all",
        });
      });
    },
  });

  const updateMutation = useMutation({
    mutationFn: (params: Parameters<typeof coreService.threads.update>[0]) =>
      coreService.threads.update(params),
    onSuccess: () => {
      [["threads", "authenticated_user"]].forEach((queryKey) => {
        queryClient.invalidateQueries({
          queryKey: queryKey,
          refetchType: "all",
        });
      });
    },
  });

  const destroyMutation = useMutation({
    mutationFn: (params: Parameters<typeof coreService.threads.destroy>[0]) =>
      coreService.threads.destroy(params),
    onSuccess: () => {
      [["threads", "authenticated_user"]].forEach((queryKey) => {
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
