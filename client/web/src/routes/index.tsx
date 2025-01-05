import { createFileRoute, redirect } from "@tanstack/react-router";

export const Route = createFileRoute("/")({
  component: Index,
  beforeLoad: async ({ context }) => {
    const authenticatedUser = await context.authState.refetch();
    if (authenticatedUser) {
      throw redirect({ to: "/dashboard" });
    }
  },
});

export function Index() {
  return <div className=""></div>;
}
