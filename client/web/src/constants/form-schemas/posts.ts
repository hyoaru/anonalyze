import * as z from "zod"
import { POST_BASE_FORM_SCHEMA } from "./core"

export const postFormSchema = z.object(POST_BASE_FORM_SCHEMA)