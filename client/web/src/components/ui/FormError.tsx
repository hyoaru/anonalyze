import { AlertCircle } from "lucide-react";

import { Alert, AlertDescription, AlertTitle } from "@/components/ui/alert";

type FormErrorProps = {
  errorMap: Record<string, string> | null;
};

export function FormError({ errorMap }: FormErrorProps) {
  if (errorMap) {
    return (
      <Alert variant="destructive">
        <AlertCircle className="h-4 w-4" />
        <AlertTitle>Error</AlertTitle>
        <AlertDescription>
          {Object.entries(errorMap).map(([key, message]) => (
            <div key={key} className="text-destructive lowercase">
              {key.replace("_", " ")}: {message}
            </div>
          ))}
        </AlertDescription>
      </Alert>
    );
  }
}
