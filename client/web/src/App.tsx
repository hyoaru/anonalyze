import { RouterProvider } from "@tanstack/react-router";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";

// App imports
import createRouter from "@/router";
import { ThemeProvider } from "./context/ThemeContext";
import "@/global.css";
import {
  AuthStateProvider,
  useAuthStateContext,
} from "./context/AuthStateContext";

const router = createRouter();

// Register the router instance for type safety
declare module "@tanstack/react-router" {
  interface Register {
    router: typeof router;
  }
}

export default function App() {
  const queryClient = new QueryClient({
    defaultOptions: {
      queries: {
        staleTime: 60 * 1000 
      }
    }
  });

  const { authenticatedUser } = useAuthStateContext();

  return (
    <ThemeProvider>
      <QueryClientProvider client={queryClient}>
        <AuthStateProvider>
          <RouterProvider
            router={router}
            context={{ queryClient, authenticatedUser }}
          />
        </AuthStateProvider>
      </QueryClientProvider>
    </ThemeProvider>
  );
}
