import { RouterProvider } from "@tanstack/react-router";

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
  return (
    <ThemeProvider>
      <AuthStateProvider>
        <InnerApp />
      </AuthStateProvider>
    </ThemeProvider>
  );
}

function InnerApp() {
  const { authenticatedUser } = useAuthStateContext();

  return <RouterProvider router={router} context={{ authenticatedUser }} />;
}
