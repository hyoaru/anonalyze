import { createFileRoute, Link } from "@tanstack/react-router";

// App imports
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import CenteredLayout from "@/components/layout/CenteredLayout";

export const Route = createFileRoute("/authentication/forgot-password")({
  component: ForgotPassword,
});

export default function ForgotPassword() {
  return (
    <CenteredLayout>
      <div className="w-full rounded-lg bg-transparent py-10 backdrop-blur-[1px] md:p-10 md:shadow lg:w-8/12 xl:w-6/12">
        <div className="text-start">
          <p className="text-3xl font-bold">Forgot Password</p>
          <p className="text-base text-primary/80">
            Enter your credentials to reset password
          </p>
        </div>

        <form className="grid">
          <div className="grid gap-4 py-8">
            <div className="grid gap-2">
              <Label>Email</Label>
              <Input />
            </div>
          </div>
          <Button
            variant={"default"}
            size={"lg"}
            className="font-bold uppercase"
          >
            Reset password
          </Button>
        </form>

        <div className="flex flex-col items-center justify-center pt-4 lg:flex-row">
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
