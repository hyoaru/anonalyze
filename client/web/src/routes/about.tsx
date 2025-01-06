import { createFileRoute } from "@tanstack/react-router";

export const Route = createFileRoute("/about")({
  component: About,
});

function About() {
  const technologies = [
    "python",
    "typescript",
    "api-first architecture",
    "php",
    "mysql",
    "rapid automatic keyword extraction",
    "docker",
    "flask",
    "swagger",
    "natural language processing",
    "scikit learn",
    "react",
    "laravel",
    "nginx",
    "reverse proxy",
    "machine learning",
    "supervised ml",
    "naive bayes",
  ];

  return (
    <>
      <div className="grid grid-cols-1 gap-4 2xl:grid-cols-2">
        <div className="">
          <div className="rounded-xl border p-8">
            <div className="space-y-4">
              <p className="text-2xl font-bold">Our story</p>
              <p className="whitespace-pre-line">
                Anonalyze began as a simple idea — a way to capture honest
                opinions without fear. As a group of pagod na computer science
                students, we were driven by the question: How can we help people
                express their thoughts more openly and create meaningful
                conversations without biases getting in the way?
                <br />
                <br />
                It all started as a thesis project. We wanted to build something
                that could take fragmented feedback — the kind you find in
                surveys, forums, and anonymous comments — and turn it into
                clear, actionable insights. Our goal was to create a tool that
                empowers people to share their true thoughts freely, while
                helping decision-makers understand the pulse of any group or
                audience at a glance.
                <br />
                <br />
                What began as an academic project quickly grew into something
                much bigger. We realized that the need for honest, anonymous
                feedback wasn’t just limited to workplaces or classrooms — it
                was something everyone could benefit from. Whether you're
                exploring opinions on current events, gathering feedback on
                ideas, or tracking sentiments over time, Anonalyze offers a way
                to unlock the power of collective insights.
                <br />
                <br />
                We believe that real insights come from real people, and that
                listening — without judgment or bias — is the key to better
                decisions, stronger communities, and greater understanding. With
                Anonalyze, our mission is to make this process simple,
                accessible, and impactful for everyone.
                <br />
                <br />
                We’re still learning, growing, and improving, but our vision
                remains the same: To turn unstructured opinions into actionable
                insights — all with just a few clicks. This is our journey. And
                we’re excited to see how Anonalyze will help shape yours.
              </p>
            </div>
          </div>
        </div>
        <div className="grid grid-cols-12 gap-4">
          <div className="col-span-4 2xl:col-span-6">
            <div className="space-y-4 rounded-xl border p-8">
              <img
                className="w-full rounded-xl object-cover"
                src="/images/cabrera.jpg"
                alt=""
              />
              <div className="text-center">
                <p className="font-bold">Cabrera, Jen Jade </p>
              </div>
            </div>
          </div>

          <div className="col-span-4 2xl:col-span-6">
            <div className="space-y-4 rounded-xl border p-8">
              <img
                className="w-full rounded-xl object-cover"
                src="/images/rubia.jpg"
                alt=""
              />
              <div className="text-center">
                <p className="font-bold">Rubia, Johaina</p>
              </div>
            </div>
          </div>

          <div className="col-span-4 2xl:col-span-6">
            <div className="space-y-4 rounded-xl border p-8">
              <img
                className="w-full rounded-xl object-cover"
                src="/images/sotelo.jpg"
                alt=""
              />
              <div className="text-center">
                <p className="font-bold">Sotelo, Mike</p>
              </div>
            </div>
          </div>

          <div className="col-span-12 2xl:col-span-6">
            <div className="space-y-4 rounded-xl border p-8">
              <p className="text-xl font-bold">Technologies used</p>
              <div className="flex flex-wrap gap-1">
                {technologies.map((technology, index) => (
                  <p
                    key={`${technology}-${index}`}
                    className="grow rounded-xl border px-2 py-1 text-center text-xs"
                  >
                    {technology}
                  </p>
                ))}
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
