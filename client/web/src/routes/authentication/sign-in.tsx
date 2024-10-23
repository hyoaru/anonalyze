import { createFileRoute, Link } from "@tanstack/react-router";

// App imports
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import CenteredLayout from "@/components/layout/CenteredLayout";

export const Route = createFileRoute("/authentication/sign-in")({
  component: SignIn,
});

export default function SignIn() {
  return (
    <CenteredLayout className="flex">
      <div className="mx-auto w-full rounded-lg bg-white p-10 shadow lg:w-8/12 xl:w-6/12">
        <div className="text-start">
          <p className="text-2xl font-bold md:text-3xl">Sign In</p>
          <p className="text-sm text-primary/80 md:text-base">
            Enter your credentials to access your account
          </p>
        </div>

        <form className="grid">
          <div className="grid gap-4 py-8">
            <div className="grid gap-2">
              <Label>Email</Label>
              <Input />
            </div>
            <div className="grid gap-2">
              <Label>Password</Label>
              <Input />
            </div>
          </div>
          <Button
            variant={"default"}
            size={"lg"}
            className="font-bold uppercase"
          >
            Sign in
          </Button>
        </form>

        <div className="flex flex-col items-center justify-center pt-4 lg:flex-row">
          <Button
            variant="link"
            asChild
            className="px-0 text-sm font-bold text-primary"
          >
            <Link href="/forgot-password">Forgot password?</Link>
          </Button>

          <hr className="mx-1 hidden w-4 border-black lg:block" />

          <p className="text-sm text-gray-600">
            Don't have an account yet?{" "}
            <Link
              to="/authentication/sign-up"
              className="font-bold text-primary hover:underline"
            >
              Sign up
            </Link>
          </p>
        </div>
      </div>
    </CenteredLayout>
  );
}
