import type { FieldApi } from "@tanstack/react-form";

export default function FieldInfo({
  field,
}: {
  field: FieldApi<any, any, any, any>;
}) {
  return (
    <>
      {field.state.meta.isTouched && field.state.meta.errors.length ? (
        <p className="text-xs text-destructive">{field.state.meta.errors}</p>
      ) : null}
      {field.state.meta.isValidating ? "Validating..." : null}
    </>
  );
}
