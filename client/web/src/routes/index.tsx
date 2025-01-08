import { Button } from "@/components/ui/button";

import { useThemeContext } from "@/context/ThemeContext";
import { createFileRoute, Link, useRouter } from "@tanstack/react-router";
import { CirclePlus, Key, Laugh, MicVocal } from "lucide-react";
import heroImgLight from "@/assets/images/hero_light_mode.png";
import heroImgDark from "@/assets/images/hero_dark_mode.png";

export const Route = createFileRoute("/")({
  component: Index,
});

export function Index() {
  const router = useRouter();
  const { theme } = useThemeContext();

  function onGetStarted() {
    router.navigate({ to: "/authentication/sign-in" });
  }

  return (
    <>
      <div className="pointer-events-auto absolute mt-[420px] w-[350] min-[460px]:mt-[360px] sm:mt-96 sm:w-[620px] md:mt-80 md:w-[750px] lg:mt-72 lg:w-[1000px] xl:mt-64 xl:w-[1300px] xl:-translate-x-[20px] 2xl:mt-44 2xl:w-[1630px] 2xl:-translate-x-[100px]">
        <div className="h-full w-full overflow-hidden">
          <img
            className="-translate-x-[20px] scale-125 opacity-80 sm:-translate-x-[50px]"
            src={theme === "light" ? heroImgLight : heroImgDark}
            alt=""
          />
        </div>
      </div>
      <div className="relative mx-auto mt-10 w-full sm:mt-20 sm:w-11/12 lg:mx-0 xl:w-8/12 2xl:w-7/12">
        <div className="space-y-6">
          <p className="text-2xl font-bold leading-tight sm:text-3xl md:text-3xl lg:text-4xl">
            Turn Feedback into Actionable Decisions. Quickly, Securely, and
            Anonymously.
          </p>
          <p className="text-sm sm:text-base">
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
            <Button
              onClick={onGetStarted}
              className="border border-main-accent bg-main-accent/5 font-bold uppercase text-main-accent hover:bg-main-accent/10"
            >
              Get Started
            </Button>
          </div>
          <Link to="/about">
            <Button variant="secondary" className="uppercase">
              Learn More
            </Button>
          </Link>
        </div>
      </div>

      <div className="h-[340px] min-[460px]:h-[380px] sm:h-[400px] md:h-[500px] lg:h-[600px] xl:h-[700px] 2xl:h-[900px]" />

      <div
        className="flex h-full w-full flex-col items-center justify-center gap-16"
        id="learnMore"
      >
        <div className="mx-auto flex w-full flex-col justify-center gap-4 text-center sm:w-11/12 lg:w-11/12 xl:w-10/12 2xl:w-9/12">
          <div className="mx-auto mb-8 w-max">
            <div className="relative w-max p-2 px-4">
              <div className="absolute inset-0 animate-ping rounded-full border border-main-accent"></div>
              <div className="absolute inset-0 rounded-full border border-main-accent"></div>
              <p className="text-xs font-bold text-main-accent">Data-Driven</p>
            </div>
          </div>
          <p className="text-xl font-bold sm:text-2xl md:text-2xl lg:text-3xl">
            Every business decision should be{" "}
            <HighlightedHeading>based on data</HighlightedHeading>
          </p>
          <p className="text-sm sm:text-base">
            But when it comes to understanding a population, traditional surveys
            fall short. The data is messy. The responses are overwhelming. And
            valuable insights get lost. Anonalyze changes that.{" "}
          </p>
        </div>

        <div className="inline-0 h-[40px] border md:h-[50px] lg:h-[100px] xl:h-[150px] 2xl:h-[200px]"></div>

        <div className="space-y-16">
          <div className="mx-auto flex w-11/12 flex-col justify-center gap-4 text-center lg:w-11/12 xl:w-10/12 2xl:w-9/12">
            <p className="text-xl font-bold sm:text-2xl md:text-2xl lg:text-3xl lg:leading-10">
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
          <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
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

        <div className="inline-0 h-[40px] border md:h-[50px] lg:h-[100px] xl:h-[150px] 2xl:h-[200px]"></div>

        <div className="mx-auto flex w-11/12 flex-col justify-center text-center">
          <p className="text-xl font-bold sm:text-2xl md:text-2xl lg:text-3xl">
            Your team’s feedback is a goldmine of insight.
          </p>

          <p className="text-xl font-bold sm:text-2xl md:text-2xl lg:text-3xl">
            <HighlightedHeading>
              Anonalyze helps you unlock it.
            </HighlightedHeading>
          </p>
        </div>
      </div>

      <div className="h-[150px] w-full sm:h-[200px] lg:h-[300px]" />

      <div
        className={
          "rounded-xl border bg-gray-50 p-4 py-14 dark:bg-secondary/20 sm:p-14 " +
          (theme === "light" && "bg-grid")
        }
      >
        <div className="mx-auto mb-8 w-max">
          <div className="relative w-max p-2 px-4">
            <div className="absolute inset-0 rounded-full border border-main-accent"></div>
            <p className="text-xs font-bold text-main-accent">Process Flow</p>
          </div>
        </div>
        <p className="text-center text-xl font-bold sm:text-2xl md:text-2xl lg:text-3xl">
          How anonalyze will work for you
        </p>
        <div className="mt-2 grid grid-cols-12 lg:mt-16">
          <div className="col-span-12 border-x border-x-foreground px-8 py-6 lg:col-span-6 2xl:col-span-4">
            <div className="flex items-center gap-6">
              <p className="hidden rounded-xl bg-main-accent p-4 text-5xl font-bold text-background sm:block">
                {"1"}
              </p>
              <div>
                <p className="text-xl font-bold md:text-xl lg:text-2xl">
                  Pose a Question
                </p>
                <p className="text-sm">
                  Pose a Question Spark meaningful conversations with
                  thought-provoking questions.
                </p>
              </div>
            </div>
          </div>

          <div className="col-span-12 border-x border-x-foreground px-8 py-6 lg:col-span-6 2xl:col-span-4">
            <div className="flex items-center gap-6">
              <p className="hidden rounded-xl bg-main-accent p-4 text-5xl font-bold text-background sm:block">
                {"2"}
              </p>
              <div>
                <p className="text-xl font-bold md:text-xl lg:text-2xl">
                  Gather Insights
                </p>
                <p className="text-sm">
                  Your subjects respond anonymously, fostering honest and
                  authentic feedback.
                </p>
              </div>
            </div>
          </div>
          <div className="col-span-12 border-x border-x-foreground px-8 py-6 lg:col-span-full 2xl:col-span-4">
            <div className="flex items-center gap-6">
              <p className="hidden rounded-xl bg-main-accent p-4 text-5xl font-bold text-background sm:block">
                {"3"}
              </p>
              <div>
                <p className="text-xl font-bold md:text-xl lg:text-2xl">
                  Get Instant Summaries
                </p>
                <p className="text-sm">
                  Watch as unstructured opinions turn into digestible summaries,
                  giving you a pulse on your organization’s mood.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div className="h-[150px] w-full sm:h-[200px] lg:h-[300px]" />

      <div className="flex flex-col items-center justify-center gap-16">
        <div className="space-y-2 text-center">
          <p className="text-xl font-bold sm:text-2xl lg:text-4xl">
            Ready to Empower Your Decisions?
          </p>
          <p className="text-sm sm:text-base lg:text-lg">
            Transform the way you gather feedback. Turn raw opinions into
            actionable insights — all at a glance.
          </p>
        </div>

        <Button
          onClick={onGetStarted}
          variant="main-accent"
          size="lg"
          className="w-max uppercase"
        >
          Get Started Now
        </Button>
      </div>

      <div className="h-[150px] w-full sm:h-[200px]" />
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
