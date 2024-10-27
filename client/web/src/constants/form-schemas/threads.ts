import * as z from "zod"
import { THREAD_BASE_FORM_SCHEMA } from "./core"

export const threadFormSchema = z.object(THREAD_BASE_FORM_SCHEMA)