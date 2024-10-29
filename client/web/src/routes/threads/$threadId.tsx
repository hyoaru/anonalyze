import LoadingComponent from "@/components/defaults/LoadingComponent";
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

  if (isLoading) return <LoadingComponent />;
  if (error) throw error;
  if (!data) throw notFound();

  return (
    <>
      <div className="">
        <div id="thread-header">
          <div className="flex flex-col gap-1">
            <p className="text-sm sm:text-base">Thread question</p>
            <p className="text-2xl font-bold sm:text-3xl">{data.question}</p>
          </div>
        </div>
        <div className="mt-8 grid overflow-hidden">
          <ThreadAnalyticMetricGroup threadId={data.id} />
        </div>
        <div className="mt-4">
          <div className="grid grid-cols-5 gap-4">
            <div className="col-span-full xl:col-span-3">
              <ThreadAnalyticWordCloud
                threadAnalyticId={data.thread_analytic?.id!}
              />
            </div>
            <div className="col-span-full xl:col-span-2">
              <div className="h-[200px] rounded-lg border bg-secondary xl:h-full">
                <div className="flex h-full w-full items-center justify-center">
                  <p className="uppercase">thread summary</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
