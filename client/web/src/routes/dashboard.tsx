import { createFileRoute, redirect } from "@tanstack/react-router";
import { CirclePlus } from "lucide-react";
import { useState } from "react";

// App imports
import { Button } from "@/components/ui/button";
import { Dialog, DialogContent, DialogDescription, DialogTitle } from "@/components/ui/dialog";
import NewThreadDialogContent from "@/components/dashboard/NewThreadDialogContent";

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

  return (
    <>
      <div className="">
        <div
          id="dashboard-header"
          className="flex items-center justify-between"
        >
          <div className="">
            <p className="">Dashboard</p>
            <p className="text-3xl font-bold">Your threads</p>
          </div>
          <Button
            variant={"main-accent"}
            onClick={() => setIsNewThreadDialogOpen(true)}
          >
            <CirclePlus />
            <span>New thread</span>
          </Button>
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
