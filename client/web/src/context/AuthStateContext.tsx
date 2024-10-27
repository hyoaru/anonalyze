import React, { createContext, useContext } from "react";
import { User } from "@/types/core-types";
import useAuthentication from "@/hooks/core/useAuthentication";

export const AuthStateContext = createContext<{
  authenticatedUser: User | undefined | null;
}>({ authenticatedUser: undefined });

export function AuthStateProvider({ children }: { children: React.ReactNode }) {
  const { data: user } = useAuthentication().authenticatedUserQuery;

  return (
    <AuthStateContext.Provider value={{ authenticatedUser: user }}>
      {children}
    </AuthStateContext.Provider>
  );
}

export function useAuthStateContext() {
  return useContext(AuthStateContext);
  // if (!context) {
  //   throw new Error(
  //     "useAuthStateContext must be used within a AuthStateProvider",
  //   );
  // }
  // return context;
}
