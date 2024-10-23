import { createRootRoute, Outlet } from "@tanstack/react-router";
import { TanStackRouterDevtools } from "@tanstack/router-devtools";

// App imports
import Header from "@/components/partial/Header";
import Footer from "@/components/partial/Footer";
import BaseContainer from "@/components/partial/BaseContainer";

export const Route = createRootRoute({
  component: Root,
});

export function Root() {
  return (
    <>
      <div className="flex min-h-screen flex-col">
        <Header />
        <BaseContainer className="my-4 grid grow rounded-lg">
          <main className="my-4 grid grow rounded-lg">
            <Outlet />
          </main>
        </BaseContainer>
        <Footer />
        <TanStackRouterDevtools />
      </div>
    </>
  );
}
