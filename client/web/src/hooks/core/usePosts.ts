import { coreService } from "@/services/coreService";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

export default function usePosts() {
  const queryClient = useQueryClient();

  const getByIdQuery = (
    params: Parameters<typeof coreService.posts.getById>[0],
  ) =>
    useQuery({
      queryFn: () => coreService.posts.getById(params),
      queryKey: ["posts", { id: params.id }],
    });

  const storeMutation = useMutation({
    mutationFn: (params: Parameters<typeof coreService.posts.store>[0]) =>
      coreService.posts.store(params),
    onSuccess: (post) => {
      [["posts"], ["threads"], ["posts", { id: post.id }]].forEach(
        (queryKey) => {
          queryClient.invalidateQueries({
            queryKey: queryKey,
            refetchType: "all",
          });
        },
      );
    },
  });

  const destroyMutation = useMutation({
    mutationFn: (params: Parameters<typeof coreService.posts.destroy>[0]) =>
      coreService.posts.destroy(params),
    onSuccess: (post) => {
      [["posts"], ["threads"], ["posts", { id: post.id }]].forEach(
        (queryKey) => {
          queryClient.invalidateQueries({
            queryKey: queryKey,
            refetchType: "all",
          });
        },
      );
    },
  });

  return {
    getByIdQuery,
    storeMutation,
    destroyMutation,
  };
}
