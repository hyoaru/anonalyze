import { useState } from "react";
import { PencilLine, Settings, Share2, Trash } from "lucide-react";
import { createFileRoute, notFound } from "@tanstack/react-router";

// App imports
import DeleteThreadDialogContent from "@/components/shared/thread/DeleteThreadDialogContent";
import EditThreadDialogContent from "@/components/shared/thread/EditThreadDialogContent";
import ThreadAnalyticMetricGroup from "@/components/threads/ThreadAnalyticMetricGroup";
import ThreadAnalyticWordCloud from "@/components/threads/ThreadAnalyticWordCloud";
import LoadingComponent from "@/components/defaults/LoadingComponent";
import { Button } from "@/components/ui/button";
import useThreads from "@/hooks/core/useThreads";
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/ui/popover";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogTitle,
} from "@/components/ui/dialog";


export const Route = createFileRoute("/threads/$threadId")({
  component: Thread,
});

export default function Thread() {
  const pathParams = Route.useParams();
  const { getByIdQuery } = useThreads();
  const { data, isLoading, error } = getByIdQuery({
    id: Number(pathParams.threadId),
  });

  const [isEditThreadDialogOpen, setIsEditThreadDialogOpen] = useState(false);
  const [isShareThreadDialogOpen, setisShareThreadDialogOpen] = useState(false);

  const [
    isDeleteThreadConfirmationDialogOpen,
    setisDeleteThreadConfirmationDialogOpen,
  ] = useState(false);

  if (isLoading) return <LoadingComponent />;
  if (error) throw error;
  if (!data) throw notFound();

  return (
    <>
      <div className="">
        <div id="thread-header">
          <div className="flex items-center">
            <div className="me-auto flex flex-col gap-1 pe-8">
              <p className="text-sm sm:text-base">Thread question</p>
              <p className="text-2xl font-bold sm:text-3xl">{data.question}</p>
            </div>
            <div className="flex flex-col gap-2 self-start">
              <Popover>
                <PopoverTrigger asChild>
                  <Button variant={"outline"} size={"icon"}>
                    <Settings />
                  </Button>
                </PopoverTrigger>
                <PopoverContent
                  side="bottom"
                  align="center"
                  className="flex w-max flex-col gap-1 border-none bg-transparent p-0 shadow-none"
                >
                  <Button
                    variant={"outline"}
                    size={"icon"}
                    onClick={() => setIsEditThreadDialogOpen(true)}
                  >
                    <PencilLine />
                  </Button>
                  <Button
                    variant={"outline"}
                    size={"icon"}
                    onClick={() =>
                      setisDeleteThreadConfirmationDialogOpen(true)
                    }
                  >
                    <Trash />
                  </Button>
                  <Button variant={"outline"} size={"icon"}>
                    <Share2 />
                  </Button>
                </PopoverContent>
              </Popover>
            </div>
          </div>
        </div>
        <div className="mt-8 grid overflow-hidden">
          <ThreadAnalyticMetricGroup threadId={data.id} />
        </div>
        <div className="mt-4">
          <div className="grid grid-cols-5 gap-4">
            <div className="col-span-full xl:col-span-3">
              <ThreadAnalyticWordCloud
                threadAnalyticId={data.thread_analytic?.id!}
              />
            </div>
            <div className="col-span-full xl:col-span-2">
              <div className="h-[200px] rounded-lg border bg-secondary xl:h-full">
                <div className="flex h-full w-full items-center justify-center">
                  <p className="uppercase">thread summary</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <Dialog
        open={isDeleteThreadConfirmationDialogOpen}
        onOpenChange={setisDeleteThreadConfirmationDialogOpen}
      >
        <DialogContent>
          <div className="hidden">
            <DialogTitle>Delete thread</DialogTitle>
            <DialogDescription></DialogDescription>
          </div>
          <DeleteThreadDialogContent
            setIsDialogOpen={setIsEditThreadDialogOpen}
            id={data.id}
          />
        </DialogContent>
      </Dialog>

      <Dialog
        open={isEditThreadDialogOpen}
        onOpenChange={setIsEditThreadDialogOpen}
      >
        <DialogContent>
          <div className="hidden">
            <DialogTitle>Edit thread</DialogTitle>
            <DialogDescription></DialogDescription>
          </div>
          <EditThreadDialogContent
            setIsDialogOpen={setIsEditThreadDialogOpen}
            id={data.id}
          />
        </DialogContent>
      </Dialog>
    </>
  );
}
