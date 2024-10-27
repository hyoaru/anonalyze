import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

// App imports
import { coreService } from "@/services/coreService";

export default function useAuthentication() {
  const queryClient = useQueryClient();

  const signInMutation = useMutation({
    mutationFn: coreService.authentication.signIn,
    onSuccess: () => {
      queryClient.invalidateQueries();
    },
  });

  const signUpMutation = useMutation({
    mutationFn: coreService.authentication.signUp,
    onSuccess: () => {
      queryClient.invalidateQueries();
    },
  });

  const signOutMutation = useMutation({
    mutationFn: coreService.authentication.signOut,
    onSuccess: () => {
      queryClient.invalidateQueries()
    },
  });

  const authenticatedUserQuery = () =>
    useQuery({
      queryFn: coreService.authentication.getAuthenticatedUser,
      queryKey: ["authenticated_user"],
    });

  return {
    signInMutation,
    signUpMutation,
    signOutMutation,
    authenticatedUserQuery,
  };
}
