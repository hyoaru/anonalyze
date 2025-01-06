import { Brackets } from "lucide-react";
import BaseContainer from "./BaseContainer";
import { Button } from "@/components/ui/button";
import { Link } from "@tanstack/react-router";

export default function Footer() {
  return (
    <footer className="pb-6 backdrop-blur-sm">
      <BaseContainer className="flex flex-col items-center text-sm sm:text-base md:flex-row">
        <div className="flex items-center gap-2 font-custom font-medium uppercase">
          <Brackets strokeWidth={2.6} size={24} className="text-main-accent" />
          <p className="">
            <span className="font-sans font-bold">©</span>
            <span className="">{" 2024 "}</span>
            <Button
              variant={"link"}
              asChild
              className="p-0 text-base font-medium"
            >
              <a href="https://github.com/hyoaru">
                <span>hyoaru</span>
              </a>
            </Button>
          </p>
          <hr className="w-8 border-foreground/20" />
          <span className="">made with tears</span>
        </div>
        <div className="flex items-center gap-2 font-custom font-medium uppercase md:ms-auto">
          <Button
            variant={"link"}
            asChild
            className="px-0 text-base font-medium"
          >
            <Link to="/about">
              <p>about</p>
            </Link>
          </Button>
          <hr className="w-8 border-foreground/20" />
          <Button
            variant={"link"}
            asChild
            className="px-0 text-base font-medium"
          >
            <a href="https://github.com/hyoaru/anonalyze">
              <p>github</p>
            </a>
          </Button>
        </div>
      </BaseContainer>
    </footer>
  );
}
