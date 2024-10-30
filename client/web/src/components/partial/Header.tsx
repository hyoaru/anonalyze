import { Brackets, Menu, Moon, Sun } from "lucide-react";

// App imports
import { Button } from "@/components/ui/button";
import { Link, useRouter } from "@tanstack/react-router";
import BaseContainer from "./BaseContainer";
import { useThemeContext } from "@/context/ThemeContext";
import useAuthentication from "@/hooks/core/useAuthentication";
import { useAuthStateContext } from "@/context/AuthStateContext";

import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
  DropdownMenuSeparator,
} from "@/components/ui/dropdown-menu";
import { toast } from "sonner";

export default function Header() {
  const router = useRouter();
  const { toggleTheme, theme } = useThemeContext();
  const authState = useAuthStateContext();
  const { signOutMutation } = useAuthentication();

  async function onSignOut() {
    await signOutMutation
      .mutateAsync()
      .then(() => {
        toast.success("Sucessfully signed out");
        router.navigate({ to: "/" });
      })
      .catch(() => {
        toast.error("An error has occured");
      });

    router.invalidate();
  }

  return (
    <header className="sticky top-0 z-40 bg-background/80 pb-2 pt-6 backdrop-blur-sm">
      <BaseContainer className="flex items-center">
        <Link to="/">
          <div id="header-start" className="flex items-center gap-4">
            <Brackets
              strokeWidth={2.6}
              size={38}
              className="text-main-accent"
            />
            <p className="font-custom text-xl font-medium uppercase">
              Anonalyze
            </p>
          </div>
        </Link>
        <div id="header-en" className="ms-auto flex items-center gap-2">
          {authState.authenticatedUser ? (
            <>
              <DropdownMenu>
                <DropdownMenuTrigger asChild>
                  <Button variant={"secondary"}>
                    <span className="hidden sm:block">
                      {authState.authenticatedUser.email}
                    </span>
                    <Menu className="sm:hidden" />
                  </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent align="end" side="bottom">
                  <DropdownMenuItem>
                    <Link className="h-full w-full" to="/dashboard">
                      Dashboard
                    </Link>
                  </DropdownMenuItem>
                  <DropdownMenuItem>Account</DropdownMenuItem>
                  <DropdownMenuItem onClick={onSignOut}>
                    Sign Out
                  </DropdownMenuItem>
                  <DropdownMenuSeparator className="sm:hidden" />
                  <DropdownMenuItem
                    className="capitalize sm:hidden"
                    onClick={toggleTheme}
                  >
                    {theme}
                  </DropdownMenuItem>
                </DropdownMenuContent>
              </DropdownMenu>
            </>
          ) : (
            <>
              <Link to="/authentication/sign-in">
                <Button variant={"secondary"} className="font-custom">
                  Sign in
                </Button>
              </Link>
            </>
          )}
          <Button
            variant={"secondary-main-accent"}
            className="hidden sm:flex"
            size={"icon"}
            onClick={toggleTheme}
          >
            {theme === "light" ? <Sun /> : <Moon />}
          </Button>
        </div>
      </BaseContainer>
    </header>
  );
}
