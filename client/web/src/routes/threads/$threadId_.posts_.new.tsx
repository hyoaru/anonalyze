import { createFileRoute, notFound } from "@tanstack/react-router";

// App imports
import CenteredLayout from "@/components/layout/CenteredLayout";
import { FormCard } from "@/components/shared/FormCard";
import PostForm from "@/components/shared/PostForm";
import usePosts from "@/hooks/core/usePosts";
import useThreads from "@/hooks/core/useThreads";
import { toast } from "sonner";

export const Route = createFileRoute("/threads/$threadId_/posts_/new")({
  component: NewThreadPost,
});

export default function NewThreadPost() {
  const navigate = Route.useNavigate();
  const pathParams = Route.useParams();
  const { storeMutation } = usePosts();
  const { getByIdQuery } = useThreads();

  const {
    data: thread,
    isLoading,
    error,
  } = getByIdQuery({
    id: Number(pathParams.threadId),
  });

  if (error) throw error;
  if (!thread && !isLoading) return notFound();

  async function onSubmit(data: Record<string, any>) {
    return await storeMutation
      .mutateAsync({
        thread_id: Number(pathParams.threadId),
        content: data.content,
      })
      .then((response) => {
        toast.success("Successfully created post to thread");
        navigate({
          to: "/threads/$threadId",
          params: { threadId: pathParams.threadId },
        });
        return response;
      })
      .catch((error) => {
        toast.error("An error has occured");
        console.log(error)
        throw error;
      });
  }

  return (
    <CenteredLayout>
      <FormCard>
        <FormCard.Header>
          <FormCard.HeaderTitle>Create new thread post</FormCard.HeaderTitle>
          <FormCard.HeaderDescription>
            Share your thoughts about the thread question. Fill in the details
            below to get started.
          </FormCard.HeaderDescription>
        </FormCard.Header>
        <FormCard.Body>
          <div className="mb-4 mt-8">
            <p className="text-sm">Thread question</p>
            <p className="text-2xl font-bold text-main-accent">
              {thread?.question}
            </p>
          </div>
          <PostForm onSubmit={onSubmit} />
        </FormCard.Body>
      </FormCard>
    </CenteredLayout>
  );
}
