import { formatDate } from "@/lib/utils";
import { coreService } from "@/services/coreService";

type ThreadTileProps = {
  thread: Awaited<
    ReturnType<typeof coreService.threads.getAllByAuthenticatedUser>
  >[number];
  threadNumber: number;
};

export default function ThreadTile({ thread, threadNumber }: ThreadTileProps) {
  const threadAnalytic = thread?.thread_analytic;
  const threadExtractedConceptGroup =
    threadAnalytic?.thread_extracted_concept_group;
  const threadConcepts = threadExtractedConceptGroup?.thread_extracted_concepts;
  const threadConceptsFormatted = threadConcepts?.length
    ? threadConcepts?.join(",")
    : "No extracted concepts yet";
  const threadCreatedAtFormatted = formatDate({date: thread.created_at})

  return (
    <div className="group flex h-full flex-col rounded-lg bg-secondary p-6 border border-transparent hover:border-main-accent/20 transition-colors duration-200 ease-in-out">
      <div className="grow flex flex-col gap-1 mb-8">
        <p className="text-sm">Thread #{threadNumber}</p>
        <p className="text-xl font-semibold group-hover:text-main-accent transition-colors duration-200 ease-in-out">{thread.question}</p>
      </div>
      
      <div className="flex flex-col gap-1">
        <p className="text-sm uppercase">{threadConceptsFormatted}</p>
        <p className="text-xs uppercase text-muted-foreground">{threadCreatedAtFormatted}</p>
      </div>
    </div>
  );
}
