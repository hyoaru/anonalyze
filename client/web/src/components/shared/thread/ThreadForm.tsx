import { zodValidator } from "@tanstack/zod-form-adapter";
import { useForm } from "@tanstack/react-form";
import { useState } from "react";
import * as z from "zod";

// App imports
import { threadFormSchema as formSchema } from "@/constants/form-schemas/threads";
import { FormError } from "@/components/ui/FormError";
import FieldInfo from "@/components/ui/FieldInfo";
import { Button } from "@/components/ui/button";
import { Label } from "@/components/ui/label";
import { Thread } from "@/types/core-types";
import { Textarea } from "@/components/ui/textarea";

type ThreadFormProps = {
  initialValues?: Thread;
  onSubmit: (data: Record<string, any>) => Promise<Thread>;
  isReadOnly?: boolean;
  isDestructive?: boolean;
};

export default function ThreadForm({
  initialValues,
  onSubmit,
  isReadOnly,
  isDestructive,
}: ThreadFormProps) {
  const [errorMap, setErrorMap] = useState<Record<string, string> | null>(null);

  const form = useForm({
    defaultValues: {
      question: initialValues?.question ?? "",
    } as z.infer<typeof formSchema>,
    validatorAdapter: zodValidator(),
    validators: {
      onChange: formSchema,
    },
    onSubmit: async ({ value }) => {
      await onSubmit(value)
        .then(() => {
          form.reset();
        })
        .catch((error) => {
          setErrorMap(
            error["response"]["data"]["errors"] as Record<string, string>,
          );
        });
    },
  });

  return (
    <>
      <div className="h-full w-full">
        <form
          className="grid"
          onSubmit={(e) => {
            e.preventDefault();
            e.stopPropagation();
            form.handleSubmit();
          }}
        >
          <div className="grid gap-4 py-8">
            <form.Field
              name="question"
              children={(field) => (
                <div className="grid gap-2">
                  <Label htmlFor={field.name}>Question</Label>
                  <Textarea
                    id={field.name}
                    name={field.name}
                    value={field.state.value}
                    onBlur={field.handleBlur}
                    onChange={(e) => field.handleChange(e.target.value)}
                    readOnly={isReadOnly}
                  />
                  <FieldInfo field={field} />
                </div>
              )}
            />

            <FormError errorMap={errorMap} />
          </div>
          <form.Subscribe
            selector={(state) => [state.canSubmit, state.isSubmitting]}
            children={([canSubmit, isSubmitting]) => (
              <Button
                variant={isDestructive ? "destructive" : "default"}
                type="submit"
                disabled={!canSubmit}
              >
                {isSubmitting ? "..." : "Submit"}
              </Button>
            )}
          />
        </form>
      </div>
    </>
  );
}
