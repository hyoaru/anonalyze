import CenteredLayout from "@/components/layout/CenteredLayout";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { FormCard } from "@/components/ui/FormCard";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import useAuthentication from "@/hooks/core/useAuthentication";
import { createFileRoute } from "@tanstack/react-router";
import { ChevronRight } from "lucide-react";

export const Route = createFileRoute("/account/")({
  component: Account,
});

function Account() {
  const { authenticatedUserQuery } = useAuthentication();
  const { data, isLoading, error } = authenticatedUserQuery();
  const navigate = Route.useNavigate();

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
                    <a
                      href=""
                      className="ms-2 text-sm text-destructive underline"
                    >
                      Verify
                    </a>
                  )}
                </Label>
                <div className="relative">
                  <div className="absolute end-[-12px] top-[-12px] uppercase">
                    {data?.email_verified_at ? (
                      <Badge>Verified</Badge>
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
