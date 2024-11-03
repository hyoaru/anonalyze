import { createFileRoute, redirect } from "@tanstack/react-router";

// App imports
import { PostTile } from "@/components/shared/post/PostTile";
import { Skeleton } from "@/components/ui/skeleton";
import usePosts from "@/hooks/core/usePosts";
import useThreads from "@/hooks/core/useThreads";
import { default as DefaultLoadingComponent } from "@/components/defaults/LoadingComponent";
import { ArrowLeft } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Link } from "@tanstack/react-router";

export const Route = createFileRoute("/threads/$threadId_/posts")({
  beforeLoad: async ({ context }) => {
    const authenticatedUser = await context.authState.refetch();
    if (!authenticatedUser) {
      throw redirect({ to: "/authentication/sign-in" });
    }
  },
  component: ThreadPosts,
});

function ThreadPosts() {
  const pathParams = Route.useParams();
  const { getByIdQuery } = useThreads();
  const { getByThreadIdQuery } = usePosts();

  const threadQuery = getByIdQuery({ id: Number(pathParams.threadId) });
  const postsQuery = getByThreadIdQuery({
    thread_id: Number(pathParams.threadId),
  });

  if (threadQuery.error || postsQuery.error) {
    throw threadQuery.error || postsQuery.error;
  }

  if (threadQuery.isLoading) return <DefaultLoadingComponent />;

  return (
    <>
      <div className="">
        <div
          id="thread-posts-header"
          className="flex items-center gap-2"
        >
          <div className="me-auto flex flex-col gap-1 pe-0 sm:pe-8">
            <p className="text-sm sm:text-base">Thread question</p>
            <p className="text-2xl font-bold sm:text-3xl">
              {threadQuery.data?.question}
            </p>
          </div>
          <Link
            to="/threads/$threadId"
            params={{ threadId: pathParams.threadId }}
          >
            <Button
              variant={"main-accent"}
              className="rounded-full bg-background p-0 text-main-accent shadow-none sm:rounded-md sm:bg-main-accent sm:p-4 sm:text-main-accent-foreground sm:shadow-sm [&_svg]:size-9 [&_svg]:shrink sm:[&_svg]:size-4 sm:[&_svg]:shrink-0"
            >
              <ArrowLeft />
              <span className="hidden sm:block">Overview</span>
            </Button>
          </Link>
        </div>
        <div className="mt-8 columns-1 space-y-4 sm:columns-2 lg:columns-3">
          {postsQuery.isLoading ? (
            <LoadingComponent />
          ) : (
            <>
              {postsQuery.data?.map((post) => (
                <PostTile key={`PostTile-${post.id}`}>
                  <PostTile.Body>
                    <PostTile.Header>Response # {post.id}</PostTile.Header>
                    <PostTile.Content>{post.content}</PostTile.Content>
                  </PostTile.Body>
                  <PostTile.Footer>
                    <PostTile.Predictions>
                      <PostTile.Sentiment
                        predictedSentiment={
                          post.post_analytic?.post_predicted_sentiment!
                        }
                      />
                      <PostTile.Emotion
                        predictedEmotion={
                          post.post_analytic?.post_predicted_emotion!
                        }
                      />
                    </PostTile.Predictions>
                    <PostTile.Date>{post.created_at}</PostTile.Date>
                  </PostTile.Footer>
                </PostTile>
              ))}
            </>
          )}
        </div>
      </div>
    </>
  );
}

function LoadingComponent() {
  return (
    <>
      {Array(21)
        .fill(0)
        .map((_, index) => (
          <Skeleton
            key={`PostTileSkeleton-${index}`}
            className="h-48 w-full break-inside-avoid rounded-lg border p-6"
          />
        ))}
    </>
  );
}
