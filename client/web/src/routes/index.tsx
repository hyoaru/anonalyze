import { Button } from "@/components/ui/button";

import { useThemeContext } from "@/context/ThemeContext";
import { createFileRoute, redirect } from "@tanstack/react-router";
import { CirclePlus, Key, Laugh, MicVocal } from "lucide-react";

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
  const { theme } = useThemeContext();
  return (
    <>
      <div className="pointer-events-auto absolute mt-44 w-full max-w-[1700px] -translate-x-[100px]">
        <div className="h-full w-full overflow-hidden">
          <img
            className="-translate-x-[50px] scale-125 opacity-80"
            src={
              theme === "light"
                ? "/images/hero_light_mode.png"
                : "/images/hero_dark_mode.png"
            }
            alt=""
          />
        </div>
      </div>
      <div className="relative mt-20">
        <div className="space-y-6">
          <p className="w-7/12 text-4xl font-bold">
            Turn Feedback into Actionable Decisions. Quickly, Securely, and
            Anonymously.
          </p>
          <p className="w-7/12">
            A powerful tool for executives to quickly understand team opinions
            on any topic. It turns unstructured feedback into actionable
            insights, helping you make informed decisions with ease.
          </p>
        </div>
        <div className="mt-12 flex items-center gap-4">
          <div className="relative">
            <div className="absolute end-[-9px] top-[-5px]">
              <div className="absolute size-4 animate-ping rounded-full border border-main-accent"></div>
              <div className="size-4 rounded-full bg-main-accent"></div>
            </div>
            <Button className="border border-main-accent bg-main-accent/5 font-bold uppercase text-main-accent hover:bg-main-accent/10">
              Get Started
            </Button>
          </div>
          <Button variant="secondary" className="uppercase">
            Learn More
          </Button>
        </div>
      </div>

      <div className="h-[900px] w-full" />

      <div className="flex h-full w-full flex-col items-center justify-center gap-16">
        <div className="mx-auto flex w-9/12 flex-col justify-center gap-4 text-center">
          <div className="mx-auto mb-8 w-max">
            <div className="relative w-max p-2 px-4">
              <div className="absolute inset-0 animate-ping rounded-full border border-main-accent"></div>
              <div className="absolute inset-0 rounded-full border border-main-accent"></div>
              <p className="text-xs font-bold text-main-accent">Data-Driven</p>
            </div>
          </div>
          <p className="text-3xl font-bold">
            Every business decision should be{" "}
            <HighlightedHeading>based on data</HighlightedHeading>
          </p>
          <p>
            But when it comes to understanding a population, traditional surveys
            fall short. The data is messy. The responses are overwhelming. And
            valuable insights get lost. Anonalyze changes that.{" "}
          </p>
        </div>

        <div className="inline-0 h-[200px] border"></div>

        <div className="space-y-16">
          <div className="mx-auto flex w-9/12 flex-col justify-center gap-4 text-center">
            <p className="text-3xl font-bold leading-10">
              We combine{" "}
              <HighlightedHeading>feedback collection</HighlightedHeading>
              {" with "}
              <HighlightedHeading>Machine Learning</HighlightedHeading>
              {", "}
              <HighlightedHeading>
                Natural Language Processing
              </HighlightedHeading>
              {", and "}
              <HighlightedHeading>AI-driven summarization</HighlightedHeading>
              {", turning unstructured responses into easy to read summaries"}
              {" that help you make faster, smarter decisions."}
            </p>
          </div>
          <div className="grid grid-cols-4 gap-4">
            <FeatureCard>
              <MicVocal className="mx-4 size-16 text-main-accent" />
              <p className="font-bold">Encourage open and genuine expression</p>
            </FeatureCard>

            <FeatureCard>
              <CirclePlus className="mx-4 size-16 text-main-accent" />
              <p className="font-bold">
                Understand collective sentiment at a glance
              </p>
            </FeatureCard>

            <FeatureCard>
              <Laugh className="mx-4 size-16 text-main-accent" />
              <p className="font-bold">
                Reveal the mood and emotion behind expressions
              </p>
            </FeatureCard>
            <FeatureCard>
              <Key className="mx-4 size-16 text-main-accent" />
              <p className="font-bold">
                Capture key ideas as they surface in discussions
              </p>
            </FeatureCard>
          </div>
        </div>

        <div className="inline-0 h-[200px] border"></div>

        <div className="mx-auto flex w-9/12 flex-col justify-center text-center">
          <p className="text-3xl font-bold leading-10">
            Your team’s feedback is a goldmine of insight.
          </p>

          <p className="text-3xl font-bold leading-10">
            <HighlightedHeading>
              Anonalyze helps you unlock it.
            </HighlightedHeading>
          </p>
        </div>
      </div>

      <div className="h-[300px] w-full" />

      <div
        className={
          "rounded-xl border bg-gray-50 p-14 dark:bg-secondary/20 " +
          (theme === "light" && "bg-grid")
        }
      >
        <div className="mx-auto mb-8 w-max">
          <div className="relative w-max p-2 px-4">
            <div className="absolute inset-0 rounded-full border border-main-accent"></div>
            <p className="text-xs font-bold text-main-accent">Process Flow</p>
          </div>
        </div>
        <p className="text-center text-3xl font-bold">
          How anonalyze will work for you
        </p>
        <div className="mt-16 grid grid-cols-3">
          <div className="border-x border-x-foreground px-8 py-6">
            <div className="flex items-center gap-6">
              <p className="rounded-xl bg-main-accent p-4 text-5xl font-bold text-background">
                {"1"}
              </p>
              <div>
                <p className="text-2xl font-bold">Pose a Question</p>
                <p className="text-sm">
                  Pose a Question Spark meaningful conversations with
                  thought-provoking questions.
                </p>
              </div>
            </div>
          </div>

          <div className="border-x border-x-foreground px-8 py-6">
            <div className="flex items-center gap-6">
              <p className="rounded-xl bg-main-accent p-4 text-5xl font-bold text-background">
                {"2"}
              </p>
              <div>
                <p className="text-2xl font-bold">Gather Insights</p>
                <p className="text-sm">
                  Your subjects respond anonymously, fostering honest and
                  authentic feedback.
                </p>
              </div>
            </div>
          </div>
          <div className="border-x border-x-foreground px-8 py-6">
            <div className="flex items-center gap-6">
              <p className="rounded-xl bg-main-accent p-4 text-5xl font-bold text-background">
                {"3"}
              </p>
              <div>
                <p className="text-2xl font-bold">Get Instant Summaries</p>
                <p className="text-sm">
                  Watch as unstructured opinions turn into digestible summaries,
                  giving you a pulse on your organization’s mood.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div className="h-[300px] w-full" />

      <div className="flex flex-col items-center justify-center gap-16">
        <div className="space-y-2 text-center">
          <p className="text-4xl font-bold">Ready to Empower Your Decisions?</p>
          <p className="text-lg">
            Transform the way you gather feedback. Turn raw opinions into
            actionable insights — all at a glance.
          </p>
        </div>

        <Button variant="main-accent" size="lg" className="w-max uppercase">
          Get Started Now
        </Button>
      </div>

      <div className="h-[200px] w-full" />
    </>
  );
}

function HighlightedHeading({ children }: { children: React.ReactNode }) {
  return (
    <span className="rounded-lg bg-main-accent px-2 text-main-accent-foreground">
      {children}
    </span>
  );
}

function FeatureCard({ children }: { children: React.ReactNode }) {
  return (
    <div className="flex items-center justify-between rounded-lg border border-main-accent bg-main-accent/5 p-4">
      {children}
    </div>
  );
}
