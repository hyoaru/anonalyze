import * as z from "zod";

export const USER_BASE_FORM_SCHEMA = {
  firstName: z.string().trim().max(256),
  lastName: z.string().trim().max(256),
  email: z.string().trim().toLowerCase().email().max(256),
  password: z
    .string()
    .trim()
    .min(8)
    .max(256)
    .min(8, { message: "Password must be at least 8 characters long" })
    .max(256, { message: "Password must not exceed 256 characters" })
    .regex(/[0-9]/, { message: "Password must contain at least one number" })
    .regex(/[a-z]/, { message: "Password must contain at least one lowercase letter" })
    .regex(/[A-Z]/, { message: "Password must contain at least one uppercase letter" }),
  passwordConfirmation: z.string().trim()
};

export const THREAD_BASE_FORM_SCHEMA = {
  question: z.string().trim().min(4).max(256),
}