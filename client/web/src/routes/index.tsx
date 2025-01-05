import { Button } from "@/components/ui/button";
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
  return (
    <>
      <div className="pointer-events-auto absolute mt-36 w-full max-w-[1700px] -translate-x-[110px]">
        <div className="h-full w-full overflow-hidden">
          <img
            className="-translate-x-[50px] scale-125 opacity-60"
            src="/images/hero_light_mode.png"
            alt=""
          />
        </div>
      </div>
      <div className="relative mt-20">
        <div className="space-y-6">
          <p className="w-5/12 text-4xl font-bold">
            Empower Your Decisions with Real Insights from Your Team
          </p>
          <p className="w-7/12">
            A powerful tool for executives to quickly understand team opinions
            on any topic. It turns unstructured feedback into actionable
            insights, helping you make informed decisions with ease.
          </p>
        </div>
        <Button className="mt-10 uppercase">Get Started</Button>
        <div className="h-[1000px] w-full" />
      </div>
    </>
  );
}
