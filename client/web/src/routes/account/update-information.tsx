import CenteredLayout from "@/components/layout/CenteredLayout";
import { Button } from "@/components/ui/button";
import { FormCard } from "@/components/ui/FormCard";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import useAuthentication from "@/hooks/core/useAuthentication";
import { createFileRoute, redirect, useRouter } from "@tanstack/react-router";
import { toast } from "sonner";
import LoadingComponent from "@/components/defaults/LoadingComponent";
import { updateInformationFormSchema as formSchema } from "@/constants/form-schemas/account";
import FieldInfo from "@/components/ui/FieldInfo";
import { FormError } from "@/components/ui/FormError";
import { useForm } from "@tanstack/react-form";
import { zodValidator } from "@tanstack/zod-form-adapter";
import { z } from "zod";
import { useState } from "react";
import useAccount from "@/hooks/core/useAccount";

export const Route = createFileRoute("/account/update-information")({
  component: UpdateInformation,
  beforeLoad: async ({ context }) => {
    const authenticatedUser = await context.authState.refetch();
    if (!authenticatedUser) {
      throw redirect({ to: "/authentication/sign-in" });
    }
  },
});

function UpdateInformation() {
  const { authenticatedUserQuery } = useAuthentication();
  const { updateInformationMutation } = useAccount();
  const { data, isLoading, error } = authenticatedUserQuery();
  const [errorMap, setErrorMap] = useState<Record<string, string> | null>(null);
  const router = useRouter();

  const form = useForm({
    defaultValues: {
      firstName: data?.first_name,
      lastName: data?.last_name,
    } as z.infer<typeof formSchema>,
    validatorAdapter: zodValidator(),
    validators: {
      onChange: formSchema,
    },
    onSubmit: async ({ value }) => {
      await updateInformationMutation
        .mutateAsync({
          first_name: value.firstName,
          last_name: value.lastName,
        })
        .then(() => {
          setErrorMap(null);
          toast.success("Successfully updated information");
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
            <FormCard.HeaderTitle>Update Information</FormCard.HeaderTitle>
            <FormCard.HeaderDescription>
              Update general information of your account
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
                      <Label htmlFor={field.name}>Last name</Label>
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
          </FormCard.Body>
        </FormCard>
      </CenteredLayout>
    </>
  );
}
