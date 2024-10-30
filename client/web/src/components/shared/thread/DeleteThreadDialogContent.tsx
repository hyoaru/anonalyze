import { useRouter } from "@tanstack/react-router";
import { toast } from "sonner";

// App imports
import useThreads from "@/hooks/core/useThreads";
import ThreadForm from "./ThreadForm";

type DeleteThreadDialogContentProps = {
  id: number;
  setIsDialogOpen?: React.Dispatch<React.SetStateAction<boolean>>;
};

export default function DeleteThreadDialogContent({
  id,
  setIsDialogOpen,
}: DeleteThreadDialogContentProps) {
  const router = useRouter();
  const { destroyMutation, getByIdQuery } = useThreads();

  const threadQuery = getByIdQuery({ id: id });

  async function onSubmit(data: Record<string, any>) {
    return await destroyMutation
      .mutateAsync({ id: id })
      .then((response) => {
        toast.success("Sucessfully deleted the thread");
        setIsDialogOpen?.(false);
        router.navigate({ to: "/dashboard" });
        return response;
      })
      .catch((error) => {
        toast.error("An error has occured");
        throw error;
      });
  }

  return (
    <div className="h-full w-full p-2">
      <p className="text-2xl font-bold text-destructive">
        Are you absolutely sure?
      </p>
      <p className="text-sm">
        This action cannot be undone. This will permanently delete your thread
        and remove it from our servers.
      </p>
      <ThreadForm
        onSubmit={onSubmit}
        initialValues={threadQuery.data}
        isReadOnly
        isDestructive
      />
    </div>
  );
}
