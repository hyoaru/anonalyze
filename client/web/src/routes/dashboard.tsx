import { coreService } from "@/services/coreService";
import { createFileRoute } from "@tanstack/react-router";

export const Route = createFileRoute("/dashboard")({
  beforeLoad: ({ context }) => {
  },
  component: () => <div>Hello /dashboard!</div>,
});
