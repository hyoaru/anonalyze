import useThreadAnalytics from "@/hooks/core/useThreadAnalytics";
import { MetricCard } from "@/components/ui/MetricCard";
import { Hash, LoaderCircle } from "lucide-react";
import { Skeleton } from "@/components/ui/skeleton";
import { ScrollArea, ScrollBar } from "@/components/ui/scroll-area";

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
      <div className="grid w-max grid-cols-5 gap-4 xl:w-full">
        {isLoading && <LoadingComponent />}
        {error && <ErrorComponent />}
        {data && (
          <>
            {metrics.map((metric) => (
              <MetricCard
                key={`metric-${metric.name}`}
                className="w-80 px-10 py-8 xl:w-full xl:py-10"
              >
                <MetricCard.Header>
                  <p className="uppercase">{metric.name}</p>
                  <Hash />
                </MetricCard.Header>
                <MetricCard.Value>{metric.value ?? "N/A"}</MetricCard.Value>
              </MetricCard>
            ))}
            <MetricCard className="w-80 px-10 py-8 xl:w-full xl:py-10">
              <MetricCard.Header>
                <p className="uppercase">key concept</p>
                <Hash />
              </MetricCard.Header>
              <MetricCard.Value
                classNames={{
                  value: data?.key_concept ? "text-sm" : "text-2xl",
                }}
              >
                {data?.key_concept ?? "N/A"}
              </MetricCard.Value>
            </MetricCard>
            <MetricCard className="w-80 px-10 py-8 xl:w-full xl:py-10">
              <MetricCard.Header>
                <p className="uppercase">sentiment ratio</p>
                <Hash />
              </MetricCard.Header>
              <MetricCard.Value>
                <span className="text-green-500">
                  {Math.round((data?.sentiment_ratio?.positive ?? 0) * 10)}
                </span>
                <span>:</span>
                <span>
                  {Math.round((data?.sentiment_ratio?.neutral ?? 0) * 10)}
                </span>
                <span>:</span>
                <span className="text-red-500">
                  {Math.round((data?.sentiment_ratio?.negative ?? 0) * 10)}
                </span>
              </MetricCard.Value>
            </MetricCard>
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
          <div
            className="relative h-40 w-72 xl:w-full"
            key={`MetricSkeletonLoading-${index}`}
          >
            <div className="absolute flex h-full w-full items-center justify-center">
              <LoaderCircle className="animate-spin" />
            </div>
            <Skeleton className="h-full w-full rounded-lg border" />
          </div>
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
            className="flex h-40 w-72 items-center justify-center rounded-lg border border-destructive bg-destructive/5 xl:w-full"
          >
            <p className="text-2xl font-bold uppercase text-destructive">
              Error
            </p>
          </div>
        ))}
    </>
  );
}
