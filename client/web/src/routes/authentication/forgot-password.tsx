import CenteredLayout from "@/components/layout/CenteredLayout";
import { Button } from "@/components/ui/button";
import FieldInfo from "@/components/ui/FieldInfo";
import { FormCard } from "@/components/ui/FormCard";
import { FormError } from "@/components/ui/FormError";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { forgotPasswordFormSchema as formSchema } from "@/constants/form-schemas/authentication";
import useAuthentication from "@/hooks/core/useAuthentication";
import { useForm } from "@tanstack/react-form";
import { createFileRoute, Link } from "@tanstack/react-router";
import { zodValidator } from "@tanstack/zod-form-adapter";
import { useState } from "react";
import { toast } from "sonner";
import { z } from "zod";

export const Route = createFileRoute("/authentication/forgot-password")({
  component: ForgotPassword,
});

export default function ForgotPassword() {
  const { forgotPasswordMutation } = useAuthentication();
  const [errorMap, setErrorMap] = useState<Record<string, string> | null>(null);

  const form = useForm({
    defaultValues: {
      email: "",
    } as z.infer<typeof formSchema>,
    validatorAdapter: zodValidator(),
    validators: {
      onChange: formSchema,
    },
    onSubmit: async ({ value }) => {
      await forgotPasswordMutation
        .mutateAsync(value)
        .then(() => {
          setErrorMap(null);
          toast.success("Successfully sent instructions to your email.");
        })
        .catch((error) => {
          setErrorMap(
            error["response"]["data"]["errors"] as Record<string, string>,
          );
          toast.error("An error has occured.");
        });
    },
  });
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
          <form
            className="grid"
            onSubmit={(e) => {
              e.preventDefault();
              e.stopPropagation();
              form.handleSubmit();
            }}
          >
            <div className="grid gap-4 py-8">
              <form.Field
                name="email"
                children={(field) => (
                  <div className="grid gap-2">
                    <Label htmlFor={field.name}>Email</Label>
                    <Input
                      id={field.name}
                      name={field.name}
                      value={field.state.value}
                      onBlur={field.handleBlur}
                      onChange={(e) => field.handleChange(e.target.value)}
                    />
                    <FieldInfo field={field} />
                  </div>
                )}
              />
              <FormError errorMap={errorMap} />
            </div>
            <form.Subscribe
              selector={(state) => [state.canSubmit, state.isSubmitting]}
              children={([canSubmit, isSubmitting]) => (
                <Button type="submit" disabled={!canSubmit}>
                  {isSubmitting ? "..." : "Submit"}
                </Button>
              )}
            />
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
