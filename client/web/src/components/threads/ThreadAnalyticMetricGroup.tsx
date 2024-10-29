import useThreadAnalytics from "@/hooks/core/useThreadAnalytics";
import { Metric } from "@/components/shared/Metric";
import { Hash } from "lucide-react";
import { Skeleton } from "../ui/skeleton";
import { ScrollArea, ScrollBar } from "../ui/scroll-area";

export default function ThreadAnalyticMetricGroup({
  threadId,
}: {
  threadId: number;
}) {
  const { getThreadAnalyticMetrics } = useThreadAnalytics();
  const { data, isLoading, error } = getThreadAnalyticMetrics({
    id: Number(threadId),
  });

  const metrics = [
    {
      name: "total response",
      value: data?.total_response,
    },
    {
      name: "leading sentiment",
      value: data?.leading_sentiment,
    },
    {
      name: "leading emotion",
      value: data?.leading_emotion,
    },
  ];

  return (
    <ScrollArea>
      <div className="grid w-max xl:w-full grid-cols-5 gap-4">
        {isLoading && <LoadingComponent />}
        {error && <ErrorComponent />}
        {data && (
          <>
            {metrics.map((metric) => (
              <Metric key={`metric-${metric.name}`} className="w-80 xl:w-full px-10 py-8 xl:py-10">
                <Metric.Header>
                  <p className="uppercase">{metric.name}</p>
                  <Hash />
                </Metric.Header>
                <Metric.Value>{metric.value}</Metric.Value>
              </Metric>
            ))}
            <Metric className="w-80 xl:w-full px-10 py-8 xl:py-10">
              <Metric.Header>
                <p className="uppercase">key concept</p>
                <Hash />
              </Metric.Header>
              <Metric.Value classNames={{ value: "text-sm" }}>
                {data?.key_concept}
              </Metric.Value>
            </Metric>
            <Metric className="w-80 xl:w-full px-10 py-8 xl:py-10">
              <Metric.Header>
                <p className="uppercase">sentiment ratio</p>
                <Hash />
              </Metric.Header>
              <Metric.Value>
                <span className="text-green-500">
                  {(data?.sentiment_ratio?.positive ?? 0) * 10}
                </span>
                <span>:</span>
                <span>{(data?.sentiment_ratio?.neutral ?? 0) * 10}</span>
                <span>:</span>
                <span className="text-red-500">
                  {(data?.sentiment_ratio?.negative ?? 0) * 10}
                </span>
              </Metric.Value>
            </Metric>
          </>
        )}
      </div>
      <ScrollBar orientation="horizontal" />
    </ScrollArea>
  );
}

function LoadingComponent() {
  return (
    <>
      {Array(5)
        .fill(0)
        .map((_, index) => (
          <Skeleton
            key={`MetricSkeletonLoading-${index}`}
            className="h-40 w-full rounded-lg border"
          />
        ))}
    </>
  );
}

function ErrorComponent() {
  return (
    <>
      {Array(5)
        .fill(0)
        .map((_, index) => (
          <div
            key={`MetricSkeletonError-${index}`}
            className="flex h-40 w-full items-center justify-center rounded-lg border border-destructive bg-destructive/20"
          >
            <p className="uppercase">Error</p>
          </div>
        ))}
    </>
  );
}
