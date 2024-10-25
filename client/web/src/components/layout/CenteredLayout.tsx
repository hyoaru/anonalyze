import React from "react";

export default function CenteredLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <div className={"h-[80vh] px-2"}>
      <div className="flex items-start justify-center md:items-center">
        {children}
      </div>
    </div>
  );
}
