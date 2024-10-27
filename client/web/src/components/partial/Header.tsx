import { Brackets, SunDim } from "lucide-react";

// App imports
import { Button } from "@/components/ui/button";
import { Link } from "@tanstack/react-router";
import BaseContainer from "./BaseContainer";
import { useThemeContext } from "@/context/ThemeContext";
import { Toggle } from "@/components/ui/toggle";

export default function Header() {
  const { toggleTheme } = useThemeContext();

  return (
    <header className="sticky top-0 z-40 bg-background/80 pb-2 pt-6 backdrop-blur-sm">
      <BaseContainer className="flex items-center">
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
          <Toggle size={"sm"} onClick={toggleTheme}>
            <SunDim />
          </Toggle>
        </div>
      </BaseContainer>
    </header>
  );
}
