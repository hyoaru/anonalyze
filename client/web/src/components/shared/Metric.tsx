import React from "react";
import { cn } from "@/lib/utils";

type MetricProps = {
  children: React.ReactNode;
  className?: string;
};

type MetricHeaderProps = {
  children: React.ReactNode;
  className?: string;
};

type MetricValueProps = {
  children: React.ReactNode;
  classNames?: {
    container?: string;
    value?: string;
  };
};

export const Metric = ({ children, className }: MetricProps) => (
  <div
    className={cn(
      "h-30 flex w-full flex-col gap-2 rounded-lg border bg-secondary p-10",
      className,
    )}
  >
    {children}
  </div>
);

const MetricHeader = ({ children, className }: MetricHeaderProps) => (
  <div className={cn("flex items-center justify-between", className)}>
    {children}
  </div>
);

const MetricValue = ({ children, classNames }: MetricValueProps) => (
  <div
    className={cn(
      "flex h-full items-center justify-start overflow-hidden",
      classNames?.container,
    )}
  >
    <p className={cn("text-2xl font-semibold", classNames?.value)}>
      {children}
    </p>
  </div>
);

Metric.Header = MetricHeader;
Metric.Value = MetricValue;
