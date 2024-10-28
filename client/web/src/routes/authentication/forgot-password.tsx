import { createFileRoute, Link } from "@tanstack/react-router";

// App imports
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import CenteredLayout from "@/components/layout/CenteredLayout";
import { FormCard } from "@/components/shared/FormCard";

export const Route = createFileRoute("/authentication/forgot-password")({
  component: ForgotPassword,
});

export default function ForgotPassword() {
  return (
    <CenteredLayout>
      <FormCard>
        <FormCard.Header>
          <FormCard.HeaderTitle>Forgot Password</FormCard.HeaderTitle>
          <FormCard.HeaderDescription>
            Enter your credentials to reset password
          </FormCard.HeaderDescription>
        </FormCard.Header>

        <FormCard.Body>
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
        </FormCard.Body>
      </FormCard>
    </CenteredLayout>
  );
}
