import {
  createFileRoute,
  Link,
  redirect,
  useRouter,
} from "@tanstack/react-router";
import { zodValidator } from "@tanstack/zod-form-adapter";
import { useForm } from "@tanstack/react-form";
import * as z from "zod";
import { toast } from "sonner";
import { useState } from "react";

// App imports
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import CenteredLayout from "@/components/layout/CenteredLayout";
import { signUpFormSchema as formSchema } from "@/constants/form-schemas/authentication";
import FieldInfo from "@/components/ui/FieldInfo";
import useAuthentication from "@/hooks/core/useAuthentication";
import { FormError } from "@/components/ui/FormError";
import { FormCard } from "@/components/ui/FormCard";

export const Route = createFileRoute("/authentication/sign-up")({
  beforeLoad: async ({ context }) => {
    const authenticatedUser = await context.authState.refetch();
    if (authenticatedUser) {
      throw redirect({
        to: "/dashboard",
      });
    }
  },
  component: SignUp,
});

export default function SignUp() {
  const router = useRouter();
  const { signUpMutation } = useAuthentication();
  const [errorMap, setErrorMap] = useState<Record<string, string> | null>(null);

  const form = useForm({
    defaultValues: {
      firstName: "",
      lastName: "",
      email: "",
      password: "",
      passwordConfirmation: "",
    } as z.infer<typeof formSchema>,
    validatorAdapter: zodValidator(),
    validators: {
      onChange: formSchema,
    },
    onSubmit: async ({ value }) => {
      await signUpMutation
        .mutateAsync({
          first_name: value.firstName,
          last_name: value.lastName,
          email: value.email,
          password: value.password,
          password_confirmation: value.passwordConfirmation,
        })
        .then(() => {
          setErrorMap(null);
          toast.success("Successfully signed in");
          router.navigate({ to: "/" });
        })
        .catch((error) => {
          setErrorMap(
            error["response"]["data"]["errors"] as Record<string, string>,
          );
          toast.error("An error has occured.");
        });

      router.invalidate();
    },
  });
  return (
    <CenteredLayout>
      <FormCard>
        <FormCard.Header>
          <FormCard.HeaderTitle>Sign Up</FormCard.HeaderTitle>
          <FormCard.HeaderDescription>
            Enter your credentials to create an account
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
                name="firstName"
                children={(field) => (
                  <div className="grid gap-2">
                    <Label htmlFor={field.name}>First name</Label>
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
              <form.Field
                name="lastName"
                children={(field) => (
                  <div className="grid gap-2">
                    <Label htmlFor={field.name}>Last Name</Label>
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
              <form.Field
                name="passwordConfirmation"
                children={(field) => (
                  <div className="grid gap-2">
                    <Label htmlFor={field.name}>Password confirmation</Label>
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
            <Button
              variant="link"
              asChild
              className="px-0 text-sm font-bold text-primary"
            >
              <Link href="/authentication/forgot-password">
                Forgot password?
              </Link>
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
        </FormCard.Body>
      </FormCard>
    </CenteredLayout>
  );
}
