import React from "react";
import { cn } from "@/lib/utils";

type FormCardProps = {
  children: React.ReactNode;
  className?: string;
};

type FormCardHeaderProps = {
  children: React.ReactNode;
  className?: string;
};

type FormCardHeaderTitleProps = {
  children: React.ReactNode;
  className?: string;
};

type FormCardHeaderDescriptionProps = {
  children: React.ReactNode;
  className?: string;
};

type FormCardBodyProps = {
  children: React.ReactNode;
};

export const FormCard = ({ children, className }: FormCardProps) => (
  <div
    className={cn(
      "w-full rounded-lg md:border bg-transparent py-10 backdrop-blur-[1px] md:p-10 lg:w-8/12 xl:w-6/12",
      className,
    )}
  >
    {children}
  </div>
);

const FormCardHeader = ({ children, className }: FormCardHeaderProps) => (
  <div className={cn("text-start", className)}>{children}</div>
);

const FormCardHeaderTitle = ({
  children,
  className,
}: FormCardHeaderTitleProps) => (
  <p className={cn("text-3xl font-bold", className)}>{children}</p>
);

const FormCardHeaderDescription = ({
  children,
  className,
}: FormCardHeaderDescriptionProps) => (
  <p className={cn("text-base text-primary/80", className)}>{children}</p>
);

const FormCardBody = ({ children }: FormCardBodyProps) => <>{children}</>;

FormCard.Header = FormCardHeader;
FormCard.HeaderTitle = FormCardHeaderTitle;
FormCard.HeaderDescription = FormCardHeaderDescription;
FormCard.Body = FormCardBody;
