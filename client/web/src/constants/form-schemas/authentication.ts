import * as z from "zod";
import { USER_BASE_FORM_SCHEMA } from "./core";

export const signUpFormSchema = z.object({
  firstName: USER_BASE_FORM_SCHEMA.firstName,
  lastName: USER_BASE_FORM_SCHEMA.lastName,
  email: USER_BASE_FORM_SCHEMA.email,
  password: USER_BASE_FORM_SCHEMA.password,
  passwordConfirmation: USER_BASE_FORM_SCHEMA.passwordConfirmation,
});

export const signInFormSchema = z.object({
  email: USER_BASE_FORM_SCHEMA.email,
  password: z.string(),
});

export const forgotPasswordFormSchema = z.object({
  email: USER_BASE_FORM_SCHEMA.email,
});

export const resetPasswordFormSchema = z.object({
  email: USER_BASE_FORM_SCHEMA.email,
  password: USER_BASE_FORM_SCHEMA.password,
});
