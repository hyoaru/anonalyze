import { toast } from "sonner";

// App imports
import useThreads from "@/hooks/core/useThreads";
import ThreadForm from "./ThreadForm";

type EditThreadDialogContentProps = {
  id: number;
  setIsDialogOpen?: React.Dispatch<React.SetStateAction<boolean>>;
};

export default function EditThreadDialogContent({
  id,
  setIsDialogOpen,
}: EditThreadDialogContentProps) {
  const { updateMutation, getByIdQuery } = useThreads();

  const threadQuery = getByIdQuery({ id: id });

  async function onSubmit(data: Record<string, any>) {
    return await updateMutation
      .mutateAsync({ question: data.question, id: id })
      .then((response) => {
        toast.success("Sucessfully created edit thread");
        setIsDialogOpen?.(false);
        return response;
      })
      .catch((error) => {
        toast.error("An error has occured");
        throw error;
      });
  }

  return (
    <div className="h-full w-full p-2">
      <p className="text-2xl font-bold">Edit thread</p>
      <p className="text-sm">
        Update the thread details to refine the discussion or share additional
        insights. Complete the form below to make your changes.
      </p>
      <ThreadForm onSubmit={onSubmit} initialValues={threadQuery.data} />
    </div>
  );
}
