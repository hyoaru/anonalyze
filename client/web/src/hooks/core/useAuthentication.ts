import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

// App imports
import { coreService } from "@/services/coreService";

export default function useAuthentication() {
  const queryClient = useQueryClient();

  const signInMutation = useMutation({
    mutationFn: coreService.authentication.signIn,
    onSuccess: async () => {
      ["authenticated_user", "users"].forEach((queryKey) => {
        queryClient.invalidateQueries({
          queryKey: [queryKey],
          refetchType: "all",
        });
      });
    },
  });

  const signUpMutation = useMutation({
    mutationFn: coreService.authentication.signUp,
    onSuccess: async () => {
      ["authenticated_user", "users"].forEach((queryKey) => {
        queryClient.invalidateQueries({
          queryKey: [queryKey],
          refetchType: "all",
        });
      });
    },
  });

  const signOutMutation = useMutation({
    mutationFn: coreService.authentication.signOut,
    onSuccess: async () => {
      ["authenticated_user", "users"].forEach((queryKey) => {
        queryClient.invalidateQueries({
          queryKey: [queryKey],
          refetchType: "all",
        });
      });
    },
  });

  const authenticatedUserQuery = useQuery({
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
