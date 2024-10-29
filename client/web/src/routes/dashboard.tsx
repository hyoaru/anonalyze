import { createFileRoute, redirect } from "@tanstack/react-router";
import { CirclePlus, LoaderCircle } from "lucide-react";
import { useState } from "react";

// App imports
import { Button } from "@/components/ui/button";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogTitle,
} from "@/components/ui/dialog";
import NewThreadDialogContent from "@/components/dashboard/NewThreadDialogContent";
import useThreads from "@/hooks/core/useThreads";
import ThreadTile from "@/components/dashboard/ThreadTile";
import { Skeleton } from "@/components/ui/skeleton";

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
        <div
          id="dashboard-header"
          className="flex items-center justify-between"
        >
          <div className="">
            <p className="text-sm sm:text-base">Dashboard</p>
            <p className="text-2xl font-bold sm:text-3xl">Your threads</p>
          </div>
          <Button
            onClick={() => setIsNewThreadDialogOpen(true)}
            className="rounded-full bg-background p-0 text-main-accent shadow-none sm:rounded-md sm:bg-main-accent sm:p-4 sm:text-main-accent-foreground sm:shadow-sm [&_svg]:size-9 [&_svg]:shrink sm:[&_svg]:size-4 sm:[&_svg]:shrink-0"
          >
            <CirclePlus />
            <span className="hidden sm:block">New thread</span>
          </Button>
        </div>

        <div className="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
          {isLoading && <ThreadTileSkeleton length={10} />}
          {data &&
            data.map((thread, index) => {
              const threadNumber = data?.length - index;

              return (
                <ThreadTile
                  key={`thread-${thread.id}`}
                  thread={thread}
                  threadNumber={threadNumber}
                />
              );
            })}
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
            className="relative h-80 w-full"
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
