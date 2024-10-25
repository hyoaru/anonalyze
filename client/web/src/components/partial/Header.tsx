import { Brackets } from "lucide-react";

// App imports
import { Button } from "@/components/ui/button";
import { Link } from "@tanstack/react-router";
import BaseContainer from "./BaseContainer";

export default function Header() {
  return (
    <header className="pt-6 pb-2 sticky top-0 z-40 bg-white/80 backdrop-blur-sm">
      <BaseContainer className="flex items-center ">
        <div id="header-start" className="flex items-center gap-4">
          <Brackets strokeWidth={2.6} size={38} className="text-main-accent" />
          <p className="font-custom text-xl font-medium uppercase">anonalyze</p>
        </div>
        <div id="header-en" className="ms-auto flex items-center gap-2">
          <Link to="/authentication/sign-in">
            <Button variant={"secondary"} className="font-custom">
              Sign in
            </Button>
          </Link>
        </div>
      </BaseContainer>
    </header>
  );
}
