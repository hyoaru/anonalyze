import CenteredLayout from "@/components/layout/CenteredLayout";
import { Button } from "@/components/ui/button";
import { FormCard } from "@/components/ui/FormCard";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import useAuthentication from "@/hooks/core/useAuthentication";
import { createFileRoute, redirect, useRouter } from "@tanstack/react-router";
import { toast } from "sonner";
import LoadingComponent from "@/components/defaults/LoadingComponent";
import { updateEmailFormSchema as formSchema } from "@/constants/form-schemas/account";
import FieldInfo from "@/components/ui/FieldInfo";
import { FormError } from "@/components/ui/FormError";
import { useForm } from "@tanstack/react-form";
import { zodValidator } from "@tanstack/zod-form-adapter";
import { z } from "zod";
import { useState } from "react";
import useAccount from "@/hooks/core/useAccount";

export const Route = createFileRoute("/account/update-email")({
  component: UpdateEmail,
  beforeLoad: async ({ context }) => {
    const authenticatedUser = await context.authState.refetch();
    if (!authenticatedUser) {
      throw redirect({ to: "/authentication/sign-in" });
    }
  },
});

function UpdateEmail() {
  const { authenticatedUserQuery } = useAuthentication();
  const { updateEmailMutation } = useAccount();
  const { data, isLoading, error } = authenticatedUserQuery();
  const [errorMap, setErrorMap] = useState<Record<string, string> | null>(null);
  const router = useRouter();

  const form = useForm({
    defaultValues: {
      newEmail: "",
      password: "",
    } as z.infer<typeof formSchema>,
    validatorAdapter: zodValidator(),
    validators: {
      onChange: formSchema,
    },
    onSubmit: async ({ value }) => {
      await updateEmailMutation
        .mutateAsync({
          new_email: value.newEmail,
          password: value.password,
        })
        .then(() => {
          setErrorMap(null);
          toast.success("Successfully updated email");
          router.navigate({ to: "/account" });
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

  if (isLoading) return <LoadingComponent />;
  if (error) throw error;

  return (
    <>
      <CenteredLayout>
        <FormCard className="">
          <FormCard.Header>
            <FormCard.HeaderTitle>Update Email</FormCard.HeaderTitle>
            <FormCard.HeaderDescription>
              Update general email of your account
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
                <div className="grid gap-2">
                  <Label className="">Current email</Label>
                  <div className="relative">
                    <Input readOnly value={data?.email} />
                  </div>
                </div>
                <form.Field
                  name="newEmail"
                  children={(field) => (
                    <div className="grid gap-2">
                      <Label htmlFor={field.name}>New email</Label>
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
                        name={field.name}
                        value={field.state.value}
                        type="password"
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
          </FormCard.Body>
        </FormCard>
      </CenteredLayout>
    </>
  );
}
