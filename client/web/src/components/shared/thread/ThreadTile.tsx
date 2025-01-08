import { Link } from "@tanstack/react-router";
import { cn, formatDate } from "@/lib/utils";
import { ThreadExtractedConcept } from "@/types/core-types";

type ThreadTileProps = {
  classNames?: {
    link?: string;
    container?: string;
  };
  children: React.ReactNode;
  threadId: number;
};

type ThreadTileBodyProps = {
  children: React.ReactNode;
  className?: string;
};

type ThreadTileNumberProps = {
  children: React.ReactNode;
  className?: string;
};

type ThreadTileQuestionProps = {
  children: React.ReactNode;
  className?: string;
};

type ThreadTileFooterProps = {
  children: React.ReactNode;
  className?: string;
};

type ThreadTileExtractedConceptsProps = {
  className?: string;
  threadExtractedConcepts: ThreadExtractedConcept[];
};

type ThreadTileDateProps = {
  className?: string;
  createdAt: Date | string;
};

export const ThreadTile = ({
  classNames,
  children,
  threadId,
}: ThreadTileProps) => (
  <Link
    className={cn(
      "group flex h-full w-full break-inside-avoid",
      classNames?.link,
    )}
    to="/threads/$threadId"
    params={{ threadId: threadId.toString() }}
  >
    <div
      className={cn(
        "flex h-full w-full break-inside-avoid flex-col rounded-lg border bg-secondary p-6 transition-colors duration-200 ease-in-out group-hover:border-main-accent/20 dark:bg-secondary/60",
        classNames?.container,
      )}
    >
      {children}
    </div>
  </Link>
);

const ThreadTileBody = ({ children, className }: ThreadTileBodyProps) => (
  <div className={cn("mb-8 flex grow flex-col gap-1", className)}>
    {children}
  </div>
);

const ThreadTileNumber = ({ children, className }: ThreadTileNumberProps) => (
  <p className={cn("text-sm", className)}>Thread #{children}</p>
);

const ThreadTileQuestion = ({
  className,
  children,
}: ThreadTileQuestionProps) => (
  <p
    className={cn(
      "text-xl font-semibold transition-colors duration-200 ease-in-out group-hover:text-main-accent",
      className,
    )}
  >
    {children}
  </p>
);

const ThreadTileFooter = ({ children, className }: ThreadTileFooterProps) => (
  <div className={cn("flex flex-col gap-1", className)}>{children}</div>
);

const ThreadTileExtractedConcepts = ({
  className,
  threadExtractedConcepts,
}: ThreadTileExtractedConceptsProps) => {
  const threadConceptsFormatted = threadExtractedConcepts?.length
    ? threadExtractedConcepts
        .slice(0, 3)
        ?.map((threadConcept) => threadConcept.concept)
        .join(",")
    : "No extracted concepts yet";
  return <p className={cn("text-sm", className)}>{threadConceptsFormatted}</p>;
};

const ThreadTileDate = ({ createdAt, className }: ThreadTileDateProps) => (
  <p className={cn("text-xs uppercase text-muted-foreground", className)}>
    {formatDate({ date: createdAt })}
  </p>
);

ThreadTile.Body = ThreadTileBody;
ThreadTile.Number = ThreadTileNumber;
ThreadTile.Question = ThreadTileQuestion;
ThreadTile.Footer = ThreadTileFooter;
ThreadTile.Concepts = ThreadTileExtractedConcepts;
ThreadTile.Date = ThreadTileDate;
