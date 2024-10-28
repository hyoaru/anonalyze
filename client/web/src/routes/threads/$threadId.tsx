import ThreadAnalyticMetricGroup from "@/components/threads/ThreadAnalyticMetricGroup";
import useThreads from "@/hooks/core/useThreads";
import { createFileRoute, notFound } from "@tanstack/react-router";

export const Route = createFileRoute("/threads/$threadId")({
  component: Thread,
});

export default function Thread() {
  const pathParams = Route.useParams();
  const { getByIdQuery } = useThreads();
  const threadQuery = getByIdQuery({
    id: Number(pathParams.threadId),
  });

  if (!threadQuery.data && !threadQuery.isLoading) throw notFound();
  if (threadQuery.error) throw threadQuery.error;

  if (threadQuery.data)
    return (
      <>
        <div className="">
          <div id="thread-header">
            <div className="flex flex-col gap-1">
              <p className="text-sm sm:text-base">Thread question</p>
              <p className="text-2xl font-bold sm:text-3xl">
                {threadQuery.data?.question}
              </p>
            </div>
          </div>

          <div className="mt-8">
            <ThreadAnalyticMetricGroup threadId={threadQuery?.data?.id} />
          </div>
        </div>
      </>
    );
}
