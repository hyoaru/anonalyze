import { createRootRouteWithContext, Outlet } from "@tanstack/react-router";
import { ReactQueryDevtools } from "@tanstack/react-query-devtools";
import { TanStackRouterDevtools } from "@tanstack/router-devtools";

// App imports
import Header from "@/components/partial/Header";
import Footer from "@/components/partial/Footer";
import BaseContainer from "@/components/partial/BaseContainer";
import { Toaster } from "@/components/ui/sonner";
import { toast } from "sonner";
import { useThemeContext } from "@/context/ThemeContext";

interface RouterContext {}

export const Route = createRootRouteWithContext<RouterContext>()({
  component: Root,
});

export function Root() {
  const { theme } = useThemeContext();
  return (
    <>
      <div className="flex min-h-screen flex-col">
        <Header />
        <BaseContainer className="grid w-full grow rounded-lg">
          <main className="grid grow overflow-auto rounded-lg px-2">
            <Outlet />
          </main>
        </BaseContainer>
        <Footer />
        <button onClick={() => toast.success("putangina")}>puta</button>
      </div>

      <Toaster richColors theme={theme} toastOptions={{}} />
      <ReactQueryDevtools />
      <TanStackRouterDevtools />
    </>
  );
}
