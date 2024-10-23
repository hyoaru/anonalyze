import { Brackets } from "lucide-react";
import BaseContainer from "./BaseContainer";

export default function Footer() {
  return (
    <footer className="pb-6 backdrop-blur-sm">
      <BaseContainer className="flex flex-col md:flex-row items-center">
        <div className="flex items-center gap-2 font-custom font-medium uppercase">
          <Brackets strokeWidth={2.6} size={24} className="text-main-accent" />
          <p>
            <span className="font-sans font-bold">©</span> 2024 hyoaru
          </p>
          <hr className="mx-1 w-8 border-black/20" />
          <p>made with tears</p>
        </div>
        <div className="md:ms-auto flex items-center font-custom font-medium uppercase">
          <p>about</p>
          <hr className="mx-1 w-8 border-black/20" />
          <p>github</p>
        </div>
      </BaseContainer>
    </footer>
  );
}
