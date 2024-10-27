import { createRouter as createTanstackRouter } from "@tanstack/react-router";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";

// App imports
import { routeTree } from "@/routeTree.gen";

export default function createRouter() {
  const queryClient = new QueryClient();

  return createTanstackRouter({
    routeTree,
    defaultPreload: "intent",
    defaultPreloadStaleTime: 0,
    context: {
      queryClient: queryClient,
      authenticatedUser: undefined!,
    },
    Wrap: ({ children }) => {
      return (
        <QueryClientProvider client={queryClient}>
          {children}
        </QueryClientProvider>
      );
    },
  });
}
