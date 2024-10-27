import { useMutation, useQuery } from "@tanstack/react-query";

// App imports
import { coreService } from "@/services/coreService";

export default function useAuthentication() {
  const signInMutation = useMutation({
    mutationFn: coreService.authentication.signIn,
    onSuccess: () => {},
  });

  const signUpMutation = useMutation({
    mutationFn: coreService.authentication.signUp,
    onSuccess: () => {},
  });

  const signOutMutation = useMutation({
    mutationFn: coreService.authentication.signOut,
    onSuccess: () => {},
  });

  const authenticatedUserQuery = useQuery({
    queryFn: coreService.authentication.getAuthenticatedUser,
    queryKey: ['authenticated_user']
  })

  return {
    signInMutation,
    signUpMutation,
    signOutMutation,
    authenticatedUserQuery
  };
}
