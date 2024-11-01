import { useRouter } from "@tanstack/react-router";
import { Button } from "@/components/ui/button";

export default function ErrorComponent({ error }: { error: Error }) {
  const router = useRouter();
  return (
    <div className="absolute inset-0 flex flex-col items-center justify-center">
      <div className="items-center-justify-center mb-10 flex flex-col gap-1 text-center">
        <p className="text-3xl font-semibold">An error has occured</p>
        <p className="text-muted-foreground">{error?.message}</p>
      </div>
      <div className="flex gap-2">
        <Button onClick={() => router.invalidate()}>Revalidate</Button>
        <Button
          onClick={() => {
            router.invalidate();
            router.navigate({ to: "/dashboard" });
          }}
        >
          Go back home
        </Button>
      </div>
    </div>
  );
}
