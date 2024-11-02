import { createFileRoute, redirect } from "@tanstack/react-router";

// App imports
import { PostTile } from "@/components/shared/post/PostTile";
import { Skeleton } from "@/components/ui/skeleton";
import usePosts from "@/hooks/core/usePosts";
import useThreads from "@/hooks/core/useThreads";
import { default as DefaultLoadingComponent } from "@/components/defaults/LoadingComponent";

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
          className="flex items-center justify-between"
        >
          <div className="">
            <p className="text-sm sm:text-base">Thread question</p>
            <p className="text-2xl font-bold sm:text-3xl">
              {threadQuery.data?.question}
            </p>
          </div>
        </div>
        <div className="mt-8 columns-3 space-y-4">
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
