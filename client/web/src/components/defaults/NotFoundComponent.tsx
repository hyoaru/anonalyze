import { useRouter } from "@tanstack/react-router";
import { Button } from "@/components/ui/button";

export default function NotFoundComponent() {
  const router = useRouter();
  return (
    <div className="absolute inset-0 flex items-center justify-center flex-col">
      <div className="items-center-justify-center mb-10 flex flex-col gap-1 text-center">
        <p className="text-3xl font-semibold">{"Oops! page not found"}</p>
        <p className="text-muted-foreground">
          {"The page you're looking for isn't here"}
        </p>
      </div>
      <Button
        onClick={() => {
          router.invalidate();
          router.navigate({ to: "/" });
        }}
      >
        Back to home
      </Button>
    </div>
  );
}
