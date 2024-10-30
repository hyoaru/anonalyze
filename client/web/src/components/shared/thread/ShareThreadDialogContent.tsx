import QRCode from "react-qr-code";
import { toast } from "sonner";

// App imports
import useThreads from "@/hooks/core/useThreads";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { Copy } from "lucide-react";

type ShareThreadDialogContentProps = {
  id: number;
  setIsDialogOpen?: React.Dispatch<React.SetStateAction<boolean>>;
};

export default function ShareThreadDialogContent({
  id,
}: ShareThreadDialogContentProps) {
  const { getByIdQuery } = useThreads();
  const { data } = getByIdQuery({ id: id });

  const url = `${location.origin}/threads/${id}`;

  async function onCopyUrl() {
    await navigator.clipboard
      .writeText(url)
      .then(() => {
        toast.success("Successfully copied to clipboard");
      })
      .catch(() => {
        toast.error("An error has occured");
      });
  }

  return (
    <div className="h-full w-full p-2">
      <div className="grid gap-1">
        <p className="text-2xl font-bold">Share thread</p>
        <p className="text-sm">
          Easily share your thread using the options below. You can either scan
          the QR code to quickly access the thread or copy the link directly to
          your clipboard.
        </p>
      </div>

      <div className="mt-6 rounded-lg border bg-secondary p-6">
        <div className="grid">
          <p className="text-xs sm:text-sm">Thread question</p>
          <p className="font-bold text-main-accent">
            {data?.question}
          </p>
        </div>

        <div className="mt-6 flex items-center justify-center">
          <div className="relative w-full rounded-lg border bg-background p-8">
            <div className="absolute end-[-14px] top-[-14px]">
              <p className="rounded-lg border bg-main-accent px-2 py-1 text-xs uppercase text-main-accent-foreground">
                scan me
              </p>
            </div>
            <div className="w-full p-2 bg-white">
              <QRCode
                value={url}
                style={{ height: "auto", maxWidth: "100%", width: "100%", }}
                viewBox={`0 0 256 256`}
              />
            </div>
          </div>
        </div>

        <div className="relative mt-6">
          <div className="absolute end-[-14px] top-[-14px]">
            <p className="rounded-lg border bg-main-accent px-2 py-1 text-xs uppercase text-main-accent-foreground">
              copy me
            </p>
          </div>
          <div className="rounded-lg border bg-background py-3">
            <div className="flex items-center px-4">
              <Input
                className="border-none bg-transparent text-xs sm:text-base"
                value={url}
                tabIndex={-1}
                readOnly
              />
              <Button
                size={"icon"}
                variant={"ghost-main-accent"}
                onClick={onCopyUrl}
              >
                <Copy />
              </Button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
