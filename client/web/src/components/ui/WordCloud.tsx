import { cn } from "@/lib/utils";
import { forwardRef, useCallback, useMemo } from "react";
import WordCloud from "react-d3-cloud";
import {
  TransformWrapper,
  TransformComponent,
  useControls,
} from "react-zoom-pan-pinch";
import { Button } from "./button";
import { Minus, Plus, RefreshCw } from "lucide-react";

type Word = { text: string; value: number };

type Props = {
  words: Word[];
  className?: string;
};

const MAX_FONT_SIZE = 80;
const MIN_FONT_SIZE = 30;
const MAX_FONT_WEIGHT = 700;
const MIN_FONT_WEIGHT = 400;
const MAX_WORDS = 150;

export const WordCloudComponent = forwardRef<HTMLDivElement, Props>(
  ({ words, className }, ref) => {
    const sortedWords = useMemo(
      () => words.sort((a, b) => b.value - a.value).slice(0, MAX_WORDS),
      [words],
    );

    const [minOccurences, maxOccurences] = useMemo(() => {
      const min = Math.min(...sortedWords.map((w) => w.value));
      const max = Math.max(...sortedWords.map((w) => w.value));
      return [min, max];
    }, [sortedWords]);

    const calculateFontSize = useCallback(
      (wordOccurrences: number) => {
        const normalizedValue =
          (wordOccurrences - minOccurences) / (maxOccurences - minOccurences);
        const fontSize =
          MIN_FONT_SIZE + normalizedValue * (MAX_FONT_SIZE - MIN_FONT_SIZE);

        return Math.round(fontSize);
      },
      [maxOccurences, minOccurences],
    );

    const calculateFontWeight = useCallback(
      (wordOccurrences: number) => {
        const normalizedValue =
          (wordOccurrences - minOccurences) / (maxOccurences - minOccurences);
        const fontWeight =
          MIN_FONT_WEIGHT +
          normalizedValue * (MAX_FONT_WEIGHT - MIN_FONT_WEIGHT);
        return Math.round(fontWeight);
      },
      [maxOccurences, minOccurences],
    );

    const calculateColor = (value: number) => {
      const normalizedValue = (value - minOccurences) / (maxOccurences - minOccurences);
      const baseRed = 255;
      const baseGreen = 91;
      const baseBlue = 26;

      const red = Math.round(baseRed - normalizedValue * (baseRed - 128));
      const green = Math.round(baseGreen - normalizedValue * (baseGreen - 50));
      const blue = Math.round(baseBlue + normalizedValue * (50 - baseBlue));
      return `rgb(${red}, ${green}, ${blue})`;

      // return "#ff5b1a";
    };

    return (
      <div className={cn("relative h-max", className)}>
        <TransformWrapper
          limitToBounds={true}
          minScale={0.9}
          centerOnInit={true}
          centerZoomedOut={true}
          wheel={{ step: 0.05 }}
        >
          <Controls />
          <TransformComponent wrapperStyle={{ width: "100%", height: "100%" }}>
            <div ref={ref} className={cn("h-full w-[1000px] uppercase")}>
              <WordCloud
                width={2000}
                font={"Fira Mono"}
                fontWeight={(word) => calculateFontWeight(word.value)}
                data={sortedWords}
                rotate={0}
                padding={1}
                fontSize={(word) => calculateFontSize(word.value)}
                fill={(word: { value: number }) => calculateColor(word.value)}
                random={() => 0.5}
              />
            </div>
          </TransformComponent>
        </TransformWrapper>
      </div>
    );
  },
);

const Controls = () => {
  const { zoomIn, zoomOut, resetTransform, centerView } = useControls();

  return (
    <div className="absolute left-3 top-3 z-10 flex gap-1">
      <Button size={"icon"} variant={"outline"} onClick={() => zoomOut()}>
        <Minus />
      </Button>
      <Button size={"icon"} variant={"outline"} onClick={() => zoomIn()}>
        <Plus />
      </Button>
      <Button
        size={"icon"}
        variant={"outline"}
        onClick={() => {
          resetTransform(0);
          centerView();
        }}
      >
        <RefreshCw />
      </Button>
    </div>
  );
};

WordCloudComponent.displayName = "WordCloud";
