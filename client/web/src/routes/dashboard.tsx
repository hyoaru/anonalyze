import { coreService } from "@/services/coreService";
import { createFileRoute } from "@tanstack/react-router";

export const Route = createFileRoute("/dashboard")({
  beforeLoad: ({ context }) => {
    context.queryClient.fetchQuery({
      queryFn: coreService.authentication.getAuthenticatedUser,
      queryKey: ["authenticated_user"],
    })
    console.log(context.queryClient.getQueryData(['authenticated_user']));
    console.log(context.authenticatedUser)
  },
  component: () => <div>Hello /dashboard!</div>,
});
