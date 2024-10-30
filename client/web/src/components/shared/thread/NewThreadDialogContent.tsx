import { toast } from "sonner";

// App imports
import useThreads from "@/hooks/core/useThreads";
import ThreadForm from "./ThreadForm";

type NewThreadDialogContentProps = {
  setIsDialogOpen?: React.Dispatch<React.SetStateAction<boolean>>
}

export default function NewThreadDialogContent({setIsDialogOpen}: NewThreadDialogContentProps) {
  const { storeMutation } = useThreads();
  async function onSubmit(data: Record<string, any>) {
    return await storeMutation
      .mutateAsync({ question: data.question })
      .then((response) => {
        toast.success("Sucessfully created new thread");
        setIsDialogOpen?.(false)
        return response;
      })
      .catch((error) => {
        toast.error("An error has occured");
        throw error
      });
  }

  return (
    <div className="h-full w-full p-2">
      <p className="text-2xl font-bold">Create new thread</p>
      <p className="text-sm">
        Share your thoughts or start a new discussion by creating a thread. Fill
        in the details below to get started.
      </p>
      <ThreadForm onSubmit={onSubmit} />
    </div>
  );
}
