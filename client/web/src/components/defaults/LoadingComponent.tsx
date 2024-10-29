import { LoaderCircle } from "lucide-react";

export default function LoadingComponent() {
  return (
    <div className="absolute inset-0 flex items-center justify-center">
      <LoaderCircle className="animate-spin" />
    </div>
  );
}
