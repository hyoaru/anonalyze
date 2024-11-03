import { useState } from "react";
import { Eye, PencilLine, Settings, Share2, Trash } from "lucide-react";
import { createFileRoute, Link, notFound } from "@tanstack/react-router";

// App imports
import ShareThreadDialogContent from "@/components/shared/thread/ShareThreadDialogContent";
import DeleteThreadDialogContent from "@/components/shared/thread/DeleteThreadDialogContent";
import EditThreadDialogContent from "@/components/shared/thread/EditThreadDialogContent";
import ThreadAnalyticMetricGroup from "@/components/threads/ThreadAnalyticMetricGroup";
import ThreadAnalyticWordCloud from "@/components/threads/ThreadAnalyticWordCloud";
import LoadingComponent from "@/components/defaults/LoadingComponent";
import { useAuthStateContext } from "@/context/AuthStateContext";
import { Button } from "@/components/ui/button";
import useThreads from "@/hooks/core/useThreads";
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/ui/popover";
import {
  Tooltip,
  TooltipContent,
  TooltipProvider,
  TooltipTrigger,
} from "@/components/ui/tooltip";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogTitle,
} from "@/components/ui/dialog";

export const Route = createFileRoute("/threads/$threadId")({
  component: Thread,
});

type ThreadSettingsControlsProps = {
  setIsEditThreadDialogOpen: React.Dispatch<React.SetStateAction<boolean>>;
  setisShareThreadDialogOpen: React.Dispatch<React.SetStateAction<boolean>>;
  setisDeleteThreadConfirmationDialogOpen: React.Dispatch<
    React.SetStateAction<boolean>
  >;
};

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
          <div className="flex items-center gap-2">
            <div className="me-auto flex flex-col gap-1 pe-0 sm:pe-8">
              <p className="text-sm sm:text-base">Thread question</p>
              <p className="text-2xl font-bold sm:text-3xl">{data.question}</p>
            </div>
            <ThreadSettingsControls
              setIsEditThreadDialogOpen={setIsEditThreadDialogOpen}
              setisDeleteThreadConfirmationDialogOpen={
                setisDeleteThreadConfirmationDialogOpen
              }
              setisShareThreadDialogOpen={setisShareThreadDialogOpen}
            />
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
        open={isShareThreadDialogOpen}
        onOpenChange={setisShareThreadDialogOpen}
      >
        <DialogContent>
          <div className="hidden">
            <DialogTitle>Share thread</DialogTitle>
            <DialogDescription></DialogDescription>
          </div>
          <ShareThreadDialogContent
            setIsDialogOpen={setIsEditThreadDialogOpen}
            id={data.id}
          />
        </DialogContent>
      </Dialog>

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

function ThreadSettingsControls({
  setIsEditThreadDialogOpen,
  setisDeleteThreadConfirmationDialogOpen,
  setisShareThreadDialogOpen,
}: ThreadSettingsControlsProps) {
  const { authenticatedUser } = useAuthStateContext();
  const pathParams = Route.useParams();

  return (
    <div className="flex flex-col gap-2">
      {authenticatedUser ? (
        <Popover>
          <PopoverTrigger asChild>
            <Button variant={"main-accent"} size={"icon"} className="z-[5]">
              <Settings />
            </Button>
          </PopoverTrigger>
          <PopoverContent
            side="bottom"
            align="center"
            className="flex w-max flex-col gap-1 border-none bg-transparent p-0 shadow-none"
          >
            <TooltipProvider>
              <Tooltip>
                <TooltipTrigger asChild>
                  <Link
                    to="/threads/$threadId/posts"
                    params={{ threadId: pathParams.threadId }}
                  >
                    <Button variant={"main-accent"} size={"icon"} tabIndex={-1}>
                      <Eye />
                    </Button>
                  </Link>
                </TooltipTrigger>
                <TooltipContent side="left">
                  <p>View posts</p>
                </TooltipContent>
              </Tooltip>
            </TooltipProvider>

            <TooltipProvider>
              <Tooltip>
                <TooltipTrigger asChild>
                  <Button
                    variant={"main-accent"}
                    size={"icon"}
                    onClick={() => setIsEditThreadDialogOpen(true)}
                    tabIndex={-1}
                  >
                    <PencilLine />
                  </Button>
                </TooltipTrigger>
                <TooltipContent side="left">
                  <p>Edit thread</p>
                </TooltipContent>
              </Tooltip>
            </TooltipProvider>

            <TooltipProvider>
              <Tooltip>
                <TooltipTrigger asChild>
                  <Button
                    variant={"main-accent"}
                    size={"icon"}
                    onClick={() =>
                      setisDeleteThreadConfirmationDialogOpen(true)
                    }
                    tabIndex={-1}
                  >
                    <Trash />
                  </Button>
                </TooltipTrigger>
                <TooltipContent side="left">
                  <p>Delete thread</p>
                </TooltipContent>
              </Tooltip>
            </TooltipProvider>

            <TooltipProvider>
              <Tooltip>
                <TooltipTrigger asChild>
                  <Button
                    variant={"main-accent"}
                    size={"icon"}
                    onClick={() => setisShareThreadDialogOpen(true)}
                    tabIndex={-1}
                  >
                    <Share2 />
                  </Button>
                </TooltipTrigger>
                <TooltipContent side="left">
                  <p>Share thread</p>
                </TooltipContent>
              </Tooltip>
            </TooltipProvider>
          </PopoverContent>
        </Popover>
      ) : (
        <TooltipProvider>
          <Tooltip>
            <TooltipTrigger asChild>
              <Button
                variant={"main-accent"}
                size={"icon"}
                onClick={() => setisShareThreadDialogOpen(true)}
              >
                <Share2 />
              </Button>
            </TooltipTrigger>
            <TooltipContent side="left">
              <p>Share thread</p>
            </TooltipContent>
          </Tooltip>
        </TooltipProvider>
      )}
    </div>
  );
}
