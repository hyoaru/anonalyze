import { StrictMode } from "react";
import ReactDOM from "react-dom/client";
import { RouterProvider } from "@tanstack/react-router";

// App imports
import { router } from "@/router";
import "@/global.css";
import { ThemeProvider } from "@/context/ThemeContext";

// Register the router instance for type safety
declare module "@tanstack/react-router" {
  interface Register {
    router: typeof router;
  }
}

// Render the app
const rootElement = document.getElementById("root")!;
if (!rootElement.innerHTML) {
  const root = ReactDOM.createRoot(rootElement);
  root.render(
    <StrictMode>
      <ThemeProvider>
        <RouterProvider router={router}/>
      </ThemeProvider>
    </StrictMode>,
  );
}
