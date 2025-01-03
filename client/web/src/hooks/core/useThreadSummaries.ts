import { CoreService } from "@/services/CoreService";
import { useQuery } from "@tanstack/react-query";

export default function useThreadSummaries() {
  /* eslint-disable react-hooks/rules-of-hooks */
  const getByIdQuery = (
    params: Parameters<typeof CoreService.threadSummary.getById>[0],
  ) =>
    useQuery({
      queryFn: () => CoreService.threadSummary.getById(params),
      queryKey: ["thread_summaries", { id: params.id }],
      refetchInterval: 10 * 1000,
    });

  return {
    getByIdQuery,
  };
}
