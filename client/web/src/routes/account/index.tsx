import CenteredLayout from "@/components/layout/CenteredLayout";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { FormCard } from "@/components/ui/FormCard";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import useAuthentication from "@/hooks/core/useAuthentication";
import { createFileRoute, redirect } from "@tanstack/react-router";
import { ChevronRight } from "lucide-react";
import { toast } from "sonner";
import LoadingComponent from "@/components/defaults/LoadingComponent";

export const Route = createFileRoute("/account/")({
  component: Account,
  beforeLoad: async ({ context }) => {
    const authenticatedUser = await context.authState.refetch();
    if (!authenticatedUser) {
      throw redirect({ to: "/authentication/sign-in" });
    }
  },
});

function Account() {
  const { authenticatedUserQuery, verifyEmailMutation } = useAuthentication();
  const { data, isLoading, error } = authenticatedUserQuery();
  const navigate = Route.useNavigate();

  async function onEmailVerify() {
    await verifyEmailMutation
      .mutateAsync()
      .then(() => {
        toast.success("Successfully sent email verification instructions");
      })
      .catch(() => {
        toast.error("An error has occured.");
      });
  }

  if (isLoading) return <LoadingComponent />;
  if (error) throw error;

  return (
    <>
      <CenteredLayout>
        <FormCard className="xl:w-10/12">
          <FormCard.Header>
            <FormCard.HeaderTitle>Account Settings</FormCard.HeaderTitle>
            <FormCard.HeaderDescription>
              Details of your account and other pertinent account operations
            </FormCard.HeaderDescription>
          </FormCard.Header>
          <FormCard.Body>
            <div className="grid gap-4 py-8">
              <div className="grid gap-2">
                <Label>Full Name</Label>
                <Input
                  readOnly
                  value={`${data?.first_name} ${data?.last_name}`}
                />
              </div>
              <div className="grid gap-2">
                <Label className="">
                  Email
                  {!data?.email_verified_at && (
                    <button
                      onClick={onEmailVerify}
                      className="ms-2 text-sm text-destructive underline"
                    >
                      Verify
                    </button>
                  )}
                </Label>
                <div className="relative">
                  <div className="absolute end-[-12px] top-[-12px] uppercase">
                    {data?.email_verified_at ? (
                      <Badge className="bg-success">Verified</Badge>
                    ) : (
                      <Badge variant="destructive">Unverified</Badge>
                    )}
                  </div>
                  <Input readOnly value={data?.email} />
                </div>
              </div>
            </div>
            <div>
              <div className="space-y-2">
                <p className="text-sm uppercase">Account Operations</p>
                <hr />
                <Button
                  variant="outline"
                  className="h-12 w-full justify-between uppercase"
                  onClick={() => {
                    navigate({ to: "/account/update-password" });
                  }}
                >
                  Update password
                  <ChevronRight />
                </Button>

                <Button
                  variant="outline"
                  className="h-12 w-full justify-between uppercase"
                  onClick={() => {
                    navigate({ to: "/account/update-information" });
                  }}
                >
                  Update information
                  <ChevronRight />
                </Button>
                <Button
                  variant="outline"
                  className="h-12 w-full justify-between uppercase"
                  onClick={() => {
                    navigate({ to: "/account/update-email" });
                  }}
                >
                  Update email
                  <ChevronRight />
                </Button>
              </div>
            </div>
          </FormCard.Body>
        </FormCard>
      </CenteredLayout>
    </>
  );
}
