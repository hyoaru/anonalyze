import React from "react";

import { cn } from "@/lib/utils";

export default function CenteredLayout({
  children,
  className,
}: {
  children: React.ReactNode;
  className?: string;
}) {
  return (
    <div className={cn("h-[55vh] items-center lg:h-[70vh]", className)}>
      {children}
    </div>
  );
}
