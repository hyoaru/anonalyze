import dayjs from "dayjs"
import { clsx, type ClassValue } from "clsx"
import { twMerge } from "tailwind-merge"

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs))
}

export function formatDate(params: {date: Date | string, format?: string}) {
  return dayjs(params.date).format(params.format ?? 'MM-DD-YYYY, HH:mm')
}