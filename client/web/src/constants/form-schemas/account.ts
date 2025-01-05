import * as z from "zod";
import { USER_BASE_FORM_SCHEMA } from "./core";

export const updateInformationFormSchema = z.object({
  firstName: USER_BASE_FORM_SCHEMA.firstName,
  lastName: USER_BASE_FORM_SCHEMA.lastName,
});

export const updateEmailFormSchema = z.object({
  email: USER_BASE_FORM_SCHEMA.email,
  password: z.string(),
});

export const updatePasswordFormSchema = z.object({
  currentPassword: z.string(),
  newPassword: USER_BASE_FORM_SCHEMA.password,
  newPasswordConfirmation: USER_BASE_FORM_SCHEMA.passwordConfirmation,
});
