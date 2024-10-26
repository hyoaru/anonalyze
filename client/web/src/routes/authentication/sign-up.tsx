import { createFileRoute, Link } from "@tanstack/react-router";

// App imports
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import CenteredLayout from "@/components/layout/CenteredLayout";

export const Route = createFileRoute("/authentication/sign-up")({
  component: SignUp,
});

export default function SignUp() {
  return (
    <CenteredLayout>
      <div className="w-full rounded-lg bg-transparent py-10 backdrop-blur-[1px] md:p-10 md:shadow lg:w-8/12 xl:w-6/12">
        <div className="text-start">
          <p className="text-3xl font-bold">Sign Up</p>
          <p className="text-base text-primary/80">
            Enter your credentials to create an account
          </p>
        </div>

        <form className="grid">
          <div className="grid gap-4 py-8">
            <div className="grid gap-2">
              <div className="grid gap-2">
                <Label>First name</Label>
                <Input />
              </div>
              <div className="grid gap-2">
                <Label>Last name</Label>
                <Input />
              </div>
              <Label>Email</Label>
              <Input />
              <div className="grid gap-2">
                <Label>Password</Label>
                <Input />
              </div>
            </div>
            <div className="grid gap-2">
              <Label>Confirm password</Label>
              <Input />
            </div>
          </div>
          <Button
            variant={"default"}
            size={"lg"}
            className="font-bold uppercase"
          >
            Sign up
          </Button>
        </form>

        <div className="flex flex-col items-center justify-center pt-4 lg:flex-row">
          <Button
            variant="link"
            asChild
            className="px-0 text-sm font-bold text-primary"
          >
            <Link href="/authentication/forgot-password">Forgot password?</Link>
          </Button>

          <hr className="mx-1 hidden w-4 border-black lg:block" />

          <p className="text-sm text-gray-600">
            Already have an account?{" "}
            <Button
              variant={"link"}
              asChild
              className="px-0 text-sm font-bold text-primary"
            >
              <Link to="/authentication/sign-in">Sign in</Link>
            </Button>
          </p>
        </div>
      </div>
    </CenteredLayout>
  );
}
