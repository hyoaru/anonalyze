import useThreadSummaries from "@/hooks/core/useThreadSummaries";
import { ScrollArea } from "../ui/scroll-area";
import { Brackets, ScrollText } from "lucide-react";

type ThreadSummaryCardProps = {
  threadId: number;
};

export default function ThreadSummaryCard({
  threadId,
}: ThreadSummaryCardProps) {
  const { getByIdQuery } = useThreadSummaries();
  const { data } = getByIdQuery({ id: threadId });

  return (
    <div className="relative h-full rounded-lg border bg-secondary">
      <div className="h-full p-10">
        {!data?.summary ? (
          <div className="absolute inset-0 flex flex-col items-center justify-center gap-4">
            <ScrollText size={150} />
            <div className="w-8/12 text-center text-sm xl:w-6/12">
              <p>
                Thread summary will be populated as the response posts are added
              </p>
            </div>
          </div>
        ) : (
          <>
            <div className="mb-4 flex items-center justify-between">
              <p className="uppercase">Thread Response Summary</p>
              <Brackets />
            </div>
            <div className="flex h-[92%]">
              <ScrollArea>
                <p className="leading-snug">{data?.summary}</p>
              </ScrollArea>
            </div>
          </>
        )}
      </div>
    </div>
  );
}
