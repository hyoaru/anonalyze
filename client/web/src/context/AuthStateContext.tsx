import React, { createContext, useContext, useEffect, useState } from "react";
import { User } from "@/types/core-types";
import { coreService } from "@/services/coreService";

export const AuthStateContext = createContext<
  { authenticatedUser: User | undefined | null } | undefined
>(undefined);

export function AuthStateProvider({ children }: { children: React.ReactNode }) {
  const [user, setUser] = useState<User | undefined | null>();

  useEffect(() => {
    coreService.authentication.getAuthenticatedUser().then((user) => {
      setUser(user);
    });
  }, []);

  return (
    <AuthStateContext.Provider value={{ authenticatedUser: user }}>
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
