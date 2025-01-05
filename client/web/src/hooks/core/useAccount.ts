import { CoreService } from "@/services/CoreService";
import { useMutation, useQueryClient } from "@tanstack/react-query";

// App imports
export default function useAccount() {
  const queryClient = useQueryClient();

  const updateInformationMutation = useMutation({
    mutationFn: CoreService.account.updateInformation,
    onSuccess: () => {
      queryClient.resetQueries();
    },
  });

  const updateEmailMutation = useMutation({
    mutationFn: CoreService.account.updateEmail,
    onSuccess: () => {
      queryClient.resetQueries();
    },
  });

  const updatePasswordMutation = useMutation({
    mutationFn: CoreService.account.updatePassword,
    onSuccess: () => {
      queryClient.resetQueries();
    },
  });

  return {
    updateInformationMutation,
    updateEmailMutation,
    updatePasswordMutation,
  };
}
