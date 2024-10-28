import { Metric } from "@/components/shared/Metric";
import useThreads from "@/hooks/core/useThreads";
import { createFileRoute, notFound } from "@tanstack/react-router";
import { Hash } from "lucide-react";

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

  const metrics = [
    {name: "total response", value: "20,000"},
    {name: "key concept", value: "Decision"},
    {name: "leading sentiment", value: "Positive"},
    {name: "leading emotion", value: "Joy"},
    {name: "sentiment ratio", value: "5:1:4"},
  ]

  return (
    <>
      <div className="">
        <div id="thread-header">
          <div className="flex flex-col gap-1">
            <p className="text-sm sm:text-base">Thread question</p>
            <p className="text-2xl font-bold sm:text-3xl">{data?.question}</p>
          </div>
        </div>

        <div className="mt-8 grid grid-cols-5 gap-4">
          {metrics.map((metric) => (
            <Metric key={`metric-${metric.name}`}>
              <Metric.Header>
                <p className="uppercase">{metric.name}</p>
                <Hash />
              </Metric.Header>
              <Metric.Value>{metric.value}</Metric.Value>
            </Metric>

          ))}
          
        </div>
      </div>
    </>
  );
}
