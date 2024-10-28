import { coreService } from "@/services/coreService";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

export default function useThreadAnalytics() {
  const queryClient = useQueryClient();

  const getByIdQuery = (
    params: Parameters<typeof coreService.threadAnalytics.getById>[0],
  ) =>
    useQuery({
      queryFn: () => coreService.threadAnalytics.getById(params),
      queryKey: ["thread_analytics", { id: params.id }],
      staleTime: 3 * 1000,
    });

  const destroyMutation = useMutation({
    mutationFn: (
      params: Parameters<typeof coreService.threadAnalytics.destroy>[0],
    ) => coreService.threadAnalytics.destroy(params),
    onSuccess: (response) => {
      [
        ["threads"],
        ["thread_analytics"],
        ["thread_analytics", { id: response.id }],
      ].forEach((queryKey) => {
        queryClient.invalidateQueries({
          queryKey: queryKey,
          refetchType: "all",
        });
      });
    },
  });

  const getThreadAnalyticMetrics = (
    params: Parameters<
      typeof coreService.threadAnalytics.getThreadAnalyticMetrics
    >[0],
  ) =>
    useQuery({
      queryFn: () => coreService.threadAnalytics.getThreadAnalyticMetrics(params),
      queryKey: ["thread_analytics_metrics", { thread_id: params.id }],
      staleTime: 3 * 1000,
    });

  return {
    getByIdQuery,
    destroyMutation,
    getThreadAnalyticMetrics,
  };
}
