import useThreadSummaries from "@/hooks/core/useThreadSummaries";
import { ScrollArea } from "../ui/scroll-area";

type ThreadSummaryCardProps = {
  threadId: number;
};

export default function ThreadSummaryCard({
  threadId,
}: ThreadSummaryCardProps) {
  const { getByIdQuery } = useThreadSummaries();
  const { data } = getByIdQuery({ id: threadId });
  return (
    <div className="h-full rounded-lg border bg-secondary">
      <div className="h-full p-8">
        <p className="mb-4 text-lg font-bold uppercase">
          Thread Response Summary
        </p>
        <div className="flex h-[92%]">
          <ScrollArea>
            <p className="leading-snug">{data?.summary}</p>
          </ScrollArea>
        </div>
      </div>
    </div>
  );
}
