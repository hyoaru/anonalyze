import { Brackets } from "lucide-react";

// App imports
import { Button } from "@/components/ui/button";

export default function Header() {
  return (
    <header className="flex items-center py-4">
      <div id="header-start" className="flex items-center gap-4">
        <Brackets strokeWidth={2.6} size={38} className="text-main-accent" />
        <p className="font-custom text-xl font-medium uppercase">anonalyze</p>
      </div>
      <div id="header-en" className="ms-auto flex items-center gap-2">
        <Button variant={"secondary"} className="font-custom">
          Sign in
        </Button>
      </div>
    </header>
  );
}
