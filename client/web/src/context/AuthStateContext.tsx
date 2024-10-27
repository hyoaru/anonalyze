import React, { createContext, useContext } from "react";

// App imports
import useAuthentication from "@/hooks/core/useAuthentication";
import { AuthStateContextType } from "@/types/auth-state";

export const AuthStateContext = createContext<AuthStateContextType | undefined>(
  undefined,
);

export function AuthStateProvider({ children }: { children: React.ReactNode }) {
  const { authenticatedUserQuery } = useAuthentication();
  const { data: user, refetch: authenticatedUserQueryRefetch } = authenticatedUserQuery()

  const refetch = async () => {
    return await authenticatedUserQueryRefetch().then((response) => {
      return response.data
    })
  };

  return (
    <AuthStateContext.Provider
      value={{ authenticatedUser: user, refetch: refetch }}
    >
      {children}
    </AuthStateContext.Provider>
  );
}

export function useAuthStateContext() {
  const context = useContext(AuthStateContext);
  if (!context) {
    throw new Error(
      "useAuthStateContext must be used within a AuthStateProvider",
    );
  }
  return context;
}
