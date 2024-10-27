import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

// App imports
import { coreService } from "@/services/coreService";

export default function useAuthentication() {
  const queryClient = useQueryClient();

  const signInMutation = useMutation({
    mutationFn: coreService.authentication.signIn,
    onSuccess: () => {
      queryClient.resetQueries();
    },
  });

  const signUpMutation = useMutation({
    mutationFn: coreService.authentication.signUp,
    onSuccess: () => {
      queryClient.resetQueries();
    },
  });

  const signOutMutation = useMutation({
    mutationFn: coreService.authentication.signOut,
    onSuccess: () => {
      queryClient.resetQueries()
    },
  });

  const authenticatedUserQuery = () =>
    useQuery({
      queryFn: coreService.authentication.getAuthenticatedUser,
      queryKey: ["authenticated_user"],
      retry: false
    });

  return {
    signInMutation,
    signUpMutation,
    signOutMutation,
    authenticatedUserQuery,
  };
}
