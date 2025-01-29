import { CoreService } from "@/services/CoreService";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

export default function useThreadAnalytics() {
  const queryClient = useQueryClient();

  /* eslint-disable react-hooks/rules-of-hooks */
  const getByIdQuery = (
    params: Parameters<typeof CoreService.threadAnalytic.getById>[0],
  ) =>
    useQuery({
      queryFn: () => CoreService.threadAnalytic.getById(params),
      queryKey: ["thread_analytics", { id: params.id }],
      refetchInterval: 3 * 1000,
    });

  const getThreadAnalyticMetrics = (
    params: Parameters<
      typeof CoreService.threadAnalytic.getThreadAnalyticMetrics
    >[0],
  ) =>
    useQuery({
      queryFn: () =>
        CoreService.threadAnalytic.getThreadAnalyticMetrics(params),
      queryKey: ["thread_analytics_metrics", { thread_id: params.id }],
      refetchInterval: 3 * 1000,
    });
  /* eslint-enable react-hooks/rules-of-hooks */

  const destroyMutation = useMutation({
    mutationFn: (
      params: Parameters<typeof CoreService.threadAnalytic.destroy>[0],
    ) => CoreService.threadAnalytic.destroy(params),
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

  return {
    getByIdQuery,
    destroyMutation,
    getThreadAnalyticMetrics,
  };
}
