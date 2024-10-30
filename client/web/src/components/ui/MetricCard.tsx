import React from "react";
import { cn } from "@/lib/utils";

type MetricCardProps = {
  children: React.ReactNode;
  className?: string;
};

type MetricCardHeaderProps = {
  children: React.ReactNode;
  className?: string;
};

type MetricCardValueProps = {
  children: React.ReactNode;
  classNames?: {
    container?: string;
    value?: string;
  };
};

export const MetricCard = ({ children, className }: MetricCardProps) => (
  <div
    className={cn(
      "flex w-full flex-col gap-2 rounded-lg border bg-secondary dark:bg-secondary/60 p-10",
      className,
    )}
  >
    {children}
  </div>
);

const MetricCardHeader = ({ children, className }: MetricCardHeaderProps) => (
  <div className={cn("flex items-center justify-between", className)}>
    {children}
  </div>
);

const MetricCardValue = ({ children, classNames }: MetricCardValueProps) => (
  <div
    className={cn(
      "flex h-full items-start justify-start text-wrap",
      classNames?.container,
    )}
  >
    <p className={cn("text-2xl font-semibold", classNames?.value)}>
      {children}
    </p>
  </div>
);

MetricCard.Header = MetricCardHeader;
MetricCard.Value = MetricCardValue;
