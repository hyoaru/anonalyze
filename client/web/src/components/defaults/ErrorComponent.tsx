import { useRouter } from "@tanstack/react-router";
import { Button } from "@/components/ui/button";

export default function ErrorComponent({ error }: { error: Error }) {
  const router = useRouter();
  return (
    <div className="flex inset-0 flex-col items-center justify-center">
      <div className="items-center-justify-center flex flex-col gap-1 text-center mb-10">
        <p className="text-3xl font-semibold">An error has occured</p>
        <p className="text-muted-foreground">{error?.message}</p>
      </div>
      <Button onClick={() => router.invalidate()}>Revalidate</Button>
    </div>
  );
}
