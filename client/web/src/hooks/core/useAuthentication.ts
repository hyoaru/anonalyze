import { useMutation } from "@tanstack/react-query";

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

  return {
    signInMutation,
    signUpMutation,
    signOutMutation,
  };
}
