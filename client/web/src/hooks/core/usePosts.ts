import { CoreService } from "@/services/CoreService";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

export default function usePosts() {
  const queryClient = useQueryClient();

  /* eslint-disable react-hooks/rules-of-hooks */
  const getByIdQuery = (
    params: Parameters<typeof CoreService.post.getById>[0],
  ) =>
    useQuery({
      queryFn: () => CoreService.post.getById(params),
      queryKey: ["posts", { id: params.id }],
    });

  const getByThreadIdQuery = (
    params: Parameters<typeof CoreService.post.getByThreadId>[0],
  ) =>
    useQuery({
      queryFn: () => CoreService.post.getByThreadId(params),
      queryKey: ["posts", { thread_id: params.thread_id }],
    });
  /* eslint-enable react-hooks/rules-of-hooks */

  const storeMutation = useMutation({
    mutationFn: (params: Parameters<typeof CoreService.post.store>[0]) =>
      CoreService.post.store(params),
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
    mutationFn: (params: Parameters<typeof CoreService.post.destroy>[0]) =>
      CoreService.post.destroy(params),
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
