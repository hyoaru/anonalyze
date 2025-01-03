// App imports
import useThreadAnalytics from "@/hooks/core/useThreadAnalytics";
import { WordCloudComponent } from "@/components/ui/WordCloud";
import { Skeleton } from "../ui/skeleton";
import { LoaderCircle } from "lucide-react";

type ThreadAnalyticWordCloudProps = {
  threadAnalyticId: number;
};

export default function ThreadAnalyticWordCloud({
  threadAnalyticId,
}: ThreadAnalyticWordCloudProps) {
  const { getByIdQuery } = useThreadAnalytics();
  const { data, isLoading, error } = getByIdQuery({ id: threadAnalyticId });

  const extracted_concepts =
    data?.thread_extracted_concept_group?.thread_extracted_concepts;

  const extracted_concepts_formatted = extracted_concepts?.map(
    (extracted_concept) => ({
      text: extracted_concept.concept,
      value: extracted_concept.significance_score,
    }),
  );

  if (isLoading) return <LoadingComponent />;
  if (error) return <ErrorComponent />;

  return (
    <>
      {data && extracted_concepts?.length ? (
        <WordCloudComponent
          words={extracted_concepts_formatted!}
          className="h-full rounded-lg border border-main-accent bg-main-accent/5"
        />
      ) : (
        <EmptyComponent />
      )}
    </>
  );
}

function LoadingComponent() {
  return (
    <div className="relative h-full w-full">
      <div className="absolute inset-0 flex items-center justify-center">
        <LoaderCircle className="animate-spin" />
      </div>
      <Skeleton className="h-full w-full rounded-lg border" />
    </div>
  );
}

function ErrorComponent() {
  return (
    <div className="flex h-96 w-full items-center justify-center rounded-lg border border-destructive bg-destructive/5">
      <p className="text-2xl font-bold uppercase text-destructive">Error</p>
    </div>
  );
}

function EmptyComponent() {
  return (
    <div className="flex h-96 w-full items-center justify-center rounded-lg border border-main-accent bg-main-accent/5">
      <p className="text-2xl font-bold uppercase text-main-accent">{"N/A"}</p>
    </div>
  );
}
