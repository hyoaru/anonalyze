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

  const getByThreadIdQuery = (
    params: Parameters<typeof coreService.posts.getByThreadId>[0],
  ) =>
    useQuery({
      queryFn: () => coreService.posts.getByThreadId(params),
      queryKey: ["posts", { thread_id: params.thread_id }],
    });

  const storeMutation = useMutation({
    mutationFn: (params: Parameters<typeof coreService.posts.store>[0]) =>
      coreService.posts.store(params),
    onSuccess: (post) => {
      [
        ["posts"],
        ["thread_analytics", { id: post.post_analytic?.id }],
        ["thread_analytic_metrics", { thread_id: post.thread_id }],
        ["threads", { id: post.thread_id }],
        ["posts", { thread_id: post.thread_id }],
        ["posts", { id: post.id }],
      ].forEach((queryKey) => {
        queryClient.invalidateQueries({
          queryKey: queryKey,
          refetchType: "all",
        });
      });
    },
  });

  const destroyMutation = useMutation({
    mutationFn: (params: Parameters<typeof coreService.posts.destroy>[0]) =>
      coreService.posts.destroy(params),
    onSuccess: (post) => {
      [
        ["posts"],
        ["thread_analytics", { id: post.post_analytic?.id }],
        ["thread_analytic_metrics", { thread_id: post.thread_id }],
        ["threads", { id: post.thread_id }],
        ["posts", { thread_id: post.thread_id }],
        ["posts", { id: post.id }],
      ].forEach((queryKey) => {
        queryClient.invalidateQueries({
          queryKey: queryKey,
          refetchType: "all",
        });
      });
    },
  });

  return {
    getByIdQuery,
    getByThreadIdQuery,
    storeMutation,
    destroyMutation,
  };
}
