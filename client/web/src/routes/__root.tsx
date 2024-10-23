import { createRootRoute, Outlet } from "@tanstack/react-router";
import { TanStackRouterDevtools } from "@tanstack/router-devtools";

// App imports
import Header from "@/components/partials/header";
import Footer from "@/components/partials/footer";

export const Route = createRootRoute({
  component: Root,
});

export function Root() {
  return (
    <>
      <div className="mx-auto px-4 md:container">
        <Header />
        <Outlet />
        <Footer />
        <TanStackRouterDevtools />
      </div>
    </>
  );
}
