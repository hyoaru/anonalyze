import { CoreService } from "@/services/CoreService";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

// App imports
export default function useAuthentication() {
  const queryClient = useQueryClient();

  /* eslint-disable react-hooks/rules-of-hooks */
  const authenticatedUserQuery = () =>
    useQuery({
      queryFn: CoreService.authentication.getAuthenticatedUser,
      queryKey: ["authenticated_user"],
      retry: false,
    });
  /* eslint-enable react-hooks/rules-of-hooks */

  const signInMutation = useMutation({
    mutationFn: CoreService.authentication.signIn,
    onSuccess: () => {
      queryClient.resetQueries();
    },
  });

  const signUpMutation = useMutation({
    mutationFn: CoreService.authentication.signUp,
    onSuccess: () => {
      queryClient.resetQueries();
    },
  });

  const signOutMutation = useMutation({
    mutationFn: CoreService.authentication.signOut,
    onSuccess: () => {
      queryClient.resetQueries();
    },
  });

  const forgotPasswordMutation = useMutation({
    mutationFn: CoreService.authentication.forgotPassword,
    onSuccess: () => {
      queryClient.resetQueries();
    },
  });

  return {
    signInMutation,
    signUpMutation,
    signOutMutation,
    authenticatedUserQuery,
    forgotPasswordMutation,
  };
}
