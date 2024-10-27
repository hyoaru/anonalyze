import { User } from "./core-types";

export type AuthStateContextType = {
  authenticatedUser: User | undefined | null;
  refetch: () => Promise<User | undefined>;
};