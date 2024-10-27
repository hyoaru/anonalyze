import { createFileRoute, Link, useRouter } from "@tanstack/react-router";
import { useForm } from "@tanstack/react-form";
import * as z from "zod";
import { zodValidator } from "@tanstack/zod-form-adapter";

// App imports
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import CenteredLayout from "@/components/layout/CenteredLayout";
import { signInFormSchema as formSchema } from "@/constants/form-schemas/authentication";
import FieldInfo from "@/components/shared/FieldInfo";
import useAuthentication from "@/hooks/core/useAuthentication";

export const Route = createFileRoute("/authentication/sign-in")({
  component: SignIn,
});

export default function SignIn() {
  const router = useRouter();
  const { signInMutation } = useAuthentication();

  const form = useForm({
    defaultValues: {
      email: "",
      password: "",
    } as z.infer<typeof formSchema>,
    validatorAdapter: zodValidator(),
    validators: {
      onChange: formSchema,
    },
    onSubmit: async ({ value }) => {
      await signInMutation
        .mutateAsync(value)
        .then((response) => {
          console.log(response);
          router.navigate({ to: "/" });
        })
        .catch((error) => {
          console.log(`errored: ${error}`);
        });
    },
  });

  return (
    <CenteredLayout>
      <div className="w-full rounded-lg bg-transparent py-10 backdrop-blur-[1px] md:p-10 md:shadow lg:w-8/12 xl:w-6/12">
        <div className="text-start">
          <p className="text-3xl font-bold">Sign In</p>
          <p className="text-base text-primary/80">
            Enter your credentials to access your account
          </p>
        </div>

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
            <Link href="/authentication/forgot-password">Forgot password?</Link>
          </Button>

          <hr className="mx-1 hidden w-4 border-black lg:block" />

          <p className="text-sm text-gray-600">
            Don't have an account yet?{" "}
            <Button
              variant={"link"}
              asChild
              className="px-0 text-sm font-bold text-primary"
            >
              <Link to="/authentication/sign-up">Sign up</Link>
            </Button>
          </p>
        </div>
      </div>
    </CenteredLayout>
  );
}
