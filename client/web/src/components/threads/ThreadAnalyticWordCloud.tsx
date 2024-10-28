// App imports
import useThreadAnalytics from "@/hooks/core/useThreadAnalytics";
import { WordCloudComponent } from "@/components/ui/WordCloud";
import { Skeleton } from "../ui/skeleton";

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
      value: extracted_concept.significance_score * 100,
    }),
  );

  return (
    <>
      {isLoading && <LoadingComponent />}
      {error && <ErrorComponent />}
      {data && (
        <WordCloudComponent
          words={extracted_concepts_formatted!}
          className="w-full rounded-lg border bg-secondary"
        />
      )}
    </>
  );
}


function LoadingComponent() {
  return <Skeleton className="w-full h-96 rounded-lg border" />
}

function ErrorComponent() {
  return <div className="w-full h-96 rounded-lg border border-destructive bg-destructive/20 flex items-center justify-center">
    <p className="uppercase">Error</p>
  </div>  
}