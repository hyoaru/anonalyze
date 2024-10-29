import ThreadAnalyticMetricGroup from "@/components/threads/ThreadAnalyticMetricGroup";
import ThreadAnalyticWordCloud from "@/components/threads/ThreadAnalyticWordCloud";
import useThreads from "@/hooks/core/useThreads";
import { createFileRoute, notFound } from "@tanstack/react-router";

export const Route = createFileRoute("/threads/$threadId")({
  component: Thread,
});

export default function Thread() {
  const pathParams = Route.useParams();
  const { getByIdQuery } = useThreads();
  const { data, isLoading, error } = getByIdQuery({
    id: Number(pathParams.threadId),
  });

  if (!data && !isLoading) throw notFound();
  if (error) throw error;

  if (isLoading || !data) {
    return <></>;
  }

  return (
    <>
      <div className="">
        <div id="thread-header">
          <div className="flex flex-col gap-1">
            <p className="text-sm sm:text-base">Thread question</p>
            <p className="text-2xl font-bold sm:text-3xl">{data.question}</p>
          </div>
        </div>
        <div className="overflow-hidden grid mt-4">
          <ThreadAnalyticMetricGroup threadId={data.id} />
        </div>
        <div className="mt-4">
            <div className="grid grid-cols-5 gap-4">
              <div className="col-span-3">
                <ThreadAnalyticWordCloud
                  threadAnalyticId={data.thread_analytic?.id!}
                />
              </div>
            </div>
          </div>
      </div>
    </>
  );
}
