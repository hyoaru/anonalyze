import { createRootRouteWithContext, Outlet } from "@tanstack/react-router";
import { ReactQueryDevtools } from "@tanstack/react-query-devtools";
import { TanStackRouterDevtools } from "@tanstack/router-devtools";

// App imports
import Header from "@/components/partial/Header";
import Footer from "@/components/partial/Footer";
import BaseContainer from "@/components/partial/BaseContainer";
import { Toaster } from "@/components/ui/sonner";
import { useThemeContext } from "@/context/ThemeContext";
import { QueryClient } from "@tanstack/react-query";
import { AuthStateContextType } from "@/types/auth-state";
import ErrorComponent from "@/components/shared/ErrorComponent";

interface RouterContext {
  queryClient: QueryClient;
  authState: AuthStateContextType;
}

export const Route = createRootRouteWithContext<RouterContext>()({
  component: Root,
  errorComponent: ({ error }) => {
    return <ErrorComponent error={error} />;
  },
});

export function Root() {
  const { theme } = useThemeContext();
  return (
    <>
      <div className="flex min-h-screen flex-col">
        <Header />
        <BaseContainer className="my-4 grid w-full grow rounded-lg">
          <main className="grid grow overflow-auto rounded-lg px-2">
            <Outlet />
          </main>
        </BaseContainer>
        <Footer />
      </div>

      <Toaster richColors theme={theme} toastOptions={{}} />
      <ReactQueryDevtools />
      <TanStackRouterDevtools />
    </>
  );
}
