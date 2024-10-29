import { formatDate } from "@/lib/utils";
import { coreService } from "@/services/coreService";
import { Link } from "@tanstack/react-router";

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
    ? threadConcepts.slice(0,3)?.map((threadConcept) => threadConcept.concept).join(",")
    : "No extracted concepts yet";
  const threadCreatedAtFormatted = formatDate({ date: thread.created_at });

  return (
    <Link
      className="group h-full"
      to="/threads/$threadId"
      params={{ threadId: thread.id.toString() }}
    >
      <div className="flex h-full flex-col rounded-lg border border-transparent bg-secondary p-6 transition-colors duration-200 ease-in-out group-hover:border-main-accent/20">
        <div className="mb-8 flex grow flex-col gap-1">
          <p className="text-sm">Thread #{threadNumber}</p>
          <p className="text-xl font-semibold transition-colors duration-200 ease-in-out group-hover:text-main-accent">
            {thread.question}
          </p>
        </div>

        <div className="flex flex-col gap-1">
          <p className="text-sm">{threadConceptsFormatted}</p>
          <p className="text-xs uppercase text-muted-foreground">
            {threadCreatedAtFormatted}
          </p>
        </div>
      </div>
    </Link>
  );
}
