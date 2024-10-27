import { useState } from "react";
import { RouterProvider } from "@tanstack/react-router";

import {
  QueryClient,
  QueryClientProvider,
  useQueryClient,
} from "@tanstack/react-query";

// App imports
import "@/global.css";
import createRouter from "@/router";
import { ThemeProvider } from "./context/ThemeContext";

import {
  AuthStateProvider,
  useAuthStateContext,
} from "@/context/AuthStateContext";

const router = createRouter();

// Register the router instance for type safety
declare module "@tanstack/react-router" {
  interface Register {
    router: typeof router;
  }
}

export default function App() {
  const [queryClient] = useState(
    () =>
      new QueryClient({
        defaultOptions: {
          queries: {
            staleTime: 60 * 1000,
            refetchOnWindowFocus: true,
          },
        },
      }),
  );

  return (
    <ThemeProvider>
      <QueryClientProvider client={queryClient}>
        <AuthStateProvider>
          <InnerApp />
        </AuthStateProvider>
      </QueryClientProvider>
    </ThemeProvider>
  );
}

function InnerApp() {
  const { authenticatedUser } = useAuthStateContext();
  const queryClient = useQueryClient();
  return (
    <RouterProvider
      router={router}
      context={{ queryClient, authenticatedUser }}
    />
  );
}
