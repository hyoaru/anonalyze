import { createFileRoute, redirect } from "@tanstack/react-router";
import { Binoculars, CirclePlus, LoaderCircle } from "lucide-react";
import { useState } from "react";

// App imports
import NewThreadDialogContent from "@/components/shared/thread/NewThreadDialogContent";
import { ThreadTile } from "@/components/shared/thread/ThreadTile";
import { Skeleton } from "@/components/ui/skeleton";
import useThreads from "@/hooks/core/useThreads";
import { Button } from "@/components/ui/button";

import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogTitle,
} from "@/components/ui/dialog";

export const Route = createFileRoute("/dashboard")({
  beforeLoad: async ({ context }) => {
    const authenticatedUser = await context.authState.refetch();
    if (!authenticatedUser) {
      throw redirect({ to: "/authentication/sign-in" });
    }
  },
  component: Dashboard,
});

export default function Dashboard() {
  const [isNewThreadDialogOpen, setIsNewThreadDialogOpen] = useState(false);
  const { getAllByAuthenticatedUserQuery } = useThreads();
  const { data, isLoading, error } = getAllByAuthenticatedUserQuery();

  if (error) throw error;

  return (
    <>
      <div className="">
        <div id="dashboard-header" className="flex items-center gap-2">
          <div className="me-auto flex flex-col gap-1 pe-0 sm:pe-8">
            <p className="text-sm sm:text-base">Dashboard</p>
            <p className="text-2xl font-bold sm:text-3xl">Your threads</p>
          </div>
          <Button
            variant={"main-accent"}
            onClick={() => setIsNewThreadDialogOpen(true)}
            className="rounded-full bg-background p-0 text-main-accent shadow-none sm:rounded-md sm:bg-main-accent sm:p-4 sm:text-main-accent-foreground sm:shadow-sm [&_svg]:size-9 [&_svg]:shrink sm:[&_svg]:size-4 sm:[&_svg]:shrink-0"
          >
            <CirclePlus />
            <span className="hidden sm:block">New thread</span>
          </Button>
        </div>

        <div className="mt-8 grid columns-1 grid-cols-1 space-y-4 sm:columns-2 lg:columns-2 xl:grid-cols-3">
          {isLoading ? (
            <ThreadTileSkeleton length={12} />
          ) : (
            <>
              {data?.length ? (
                data.map((thread, index) => {
                  const threadNumber = data?.length - index;

                  return (
                    <ThreadTile
                      threadId={thread.id}
                      key={`ThreadTile-${thread.id}`}
                    >
                      <ThreadTile.Body>
                        <ThreadTile.Number>{threadNumber}</ThreadTile.Number>
                        <ThreadTile.Question>
                          {thread.question}
                        </ThreadTile.Question>
                      </ThreadTile.Body>
                      <ThreadTile.Footer>
                        {thread.thread_analytic?.thread_extracted_concept_group
                          ?.thread_extracted_concepts && (
                          <>
                            <ThreadTile.Concepts
                              threadExtractedConcepts={
                                thread.thread_analytic
                                  ?.thread_extracted_concept_group
                                  ?.thread_extracted_concepts
                              }
                            />
                          </>
                        )}
                        <ThreadTile.Date createdAt={thread.created_at} />
                      </ThreadTile.Footer>
                    </ThreadTile>
                  );
                })
              ) : (
                <>
                  <div className="pointer-events-none absolute inset-0 col-span-full flex w-full flex-col items-center justify-center">
                    <Binoculars size={200} />
                    <p className="mt-4 text-2xl font-semibold">
                      No threads yet
                    </p>
                    <Button
                      size={"sm"}
                      variant={"link"}
                      className="pointer-events-auto h-max p-0"
                      onClick={() => setIsNewThreadDialogOpen(true)}
                    >
                      <p className="text-sm">Create new thread</p>
                    </Button>
                  </div>
                </>
              )}
            </>
          )}
        </div>
      </div>

      <Dialog
        open={isNewThreadDialogOpen}
        onOpenChange={setIsNewThreadDialogOpen}
      >
        <DialogContent>
          <div className="hidden">
            <DialogTitle>New thread</DialogTitle>
            <DialogDescription></DialogDescription>
          </div>
          <NewThreadDialogContent setIsDialogOpen={setIsNewThreadDialogOpen} />
        </DialogContent>
      </Dialog>
    </>
  );
}

function ThreadTileSkeleton({ length }: { length: number }) {
  return (
    <>
      {Array(length)
        .fill(0)
        .map((_, index) => (
          <div
            key={`ThreadTileSkeleton-${index}`}
            className="relative h-72 w-full"
          >
            <div className="absolute inset-0 flex items-center justify-center">
              <LoaderCircle className="animate-spin" />
            </div>
            <Skeleton className="h-full w-full" />
          </div>
        ))}
    </>
  );
}
