import CenteredLayout from "@/components/layout/CenteredLayout";
import { Button } from "@/components/ui/button";
import FieldInfo from "@/components/ui/FieldInfo";
import { FormCard } from "@/components/ui/FormCard";
import { FormError } from "@/components/ui/FormError";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { resetPasswordFormSchema as formSchema } from "@/constants/form-schemas/authentication";
import useAuthentication from "@/hooks/core/useAuthentication";
import { useForm } from "@tanstack/react-form";
import { createFileRoute, Link, redirect } from "@tanstack/react-router";
import { zodValidator as zodRouteValidator } from "@tanstack/zod-adapter";
import { zodValidator as zodFormValidator } from "@tanstack/zod-form-adapter";
import { useState } from "react";
import { toast } from "sonner";
import { z } from "zod";

const ResetPasswordSearchSchema = z.object({
  token: z.string(),
  email: z.string(),
});

export const Route = createFileRoute("/authentication/reset-password")({
  component: ResetPassword,
  beforeLoad: ({ search }) => {
    if (!search.token && !search.email) {
      throw redirect({
        to: "/authentication/forgot-password",
      });
    }
  },
  validateSearch: zodRouteValidator(ResetPasswordSearchSchema),
});

export default function ResetPassword() {
  const searchParams = Route.useSearch();
  const navigate = Route.useNavigate();
  const { resetPasswordMutation } = useAuthentication();
  const [errorMap, setErrorMap] = useState<Record<string, string> | null>(null);

  const form = useForm({
    defaultValues: {
      email: searchParams.email,
      password: "",
    } as z.infer<typeof formSchema>,
    validatorAdapter: zodFormValidator(),
    validators: {
      onChange: formSchema,
    },
    onSubmit: async ({ value }) => {
      await resetPasswordMutation
        .mutateAsync({
          email: value.email,
          password: value.password,
          token: searchParams.token,
        })
        .then(() => {
          setErrorMap(null);
          toast.success("Successfully updated password.");
          navigate({ to: "/authentication/sign-in" });
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
          <FormCard.HeaderTitle>Reset Password</FormCard.HeaderTitle>
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
                      readOnly
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
              <form.Field
                name="password"
                children={(field) => (
                  <div className="grid gap-2">
                    <Label htmlFor={field.name}>Password</Label>
                    <Input
                      id={field.name}
                      type="password"
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
