import React from "react";

// App imports
import { cn, formatDate } from "@/lib/utils";
import EmotionEmoji from "@/components/ui/EmotionEmoji";
import SentimentEmoji from "@/components/ui/SentimentEmoji";
import {
  PostPredictedEmotion,
  PostPredictedSentiment,
} from "@/types/core-types";
import {
  Tooltip,
  TooltipContent,
  TooltipProvider,
  TooltipTrigger,
} from "@/components/ui/tooltip";

type PostTileType = {
  children: React.ReactNode;
  className?: string;
  sentiment?: "positive" | "negative" | "neutral";
};

type PostTileBodyType = {
  children: React.ReactNode;
  className?: string;
};

type PostTileHeaderType = {
  children: React.ReactNode;
  className?: string;
};

type PostTileContentType = {
  children: React.ReactNode;
  className?: string;
};

type PostTileFooterType = {
  children: React.ReactNode;
  className?: string;
};

type PostTileDateType = {
  children: React.ReactNode;
  className?: string;
};

type PostTilePredictionsType = {
  children: React.ReactNode;
  className?: string;
};

type PostTileEmotionType = {
  predictedEmotion: PostPredictedEmotion;
  className?: string;
};

type PostTileSentimentType = {
  predictedSentiment: PostPredictedSentiment;
  className?: string;
};

export const PostTile = ({ children, className, sentiment }: PostTileType) => (
  <div
    className={cn(
      "group flex h-full break-inside-avoid flex-col rounded-lg border bg-secondary p-6 transition-colors duration-200 ease-in-out",
      sentiment === "positive"
        ? "border-success/40 bg-success/10 dark:bg-success/20"
        : sentiment === "negative"
          ? "border-destructive/40 bg-destructive/10 dark:bg-destructive/20"
          : "",
      className,
    )}
  >
    {children}
  </div>
);

const PostTileBody = ({ children, className }: PostTileBodyType) => (
  <div className={cn("mb-8 flex grow flex-col gap-1", className)}>
    {children}
  </div>
);

const PostTileHeader = ({ children, className }: PostTileHeaderType) => (
  <p className={cn("text-sm", className)}>{children}</p>
);

const PostTileContent = ({ children, className }: PostTileContentType) => (
  <p
    className={cn(
      "text-xl font-semibold transition-colors duration-200 ease-in-out",
      className,
    )}
  >
    {children}
  </p>
);

const PostTileFooter = ({ children, className }: PostTileFooterType) => (
  <div className={cn("flex flex-col gap-2", className)}>{children}</div>
);

const PostTileDate = ({ children, className }: PostTileDateType) => (
  <p className={cn("text-xs uppercase text-muted-foreground", className)}>
    {formatDate({ date: children as string })}
  </p>
);

const PostTileEmotion = ({
  predictedEmotion,
  className,
}: PostTileEmotionType) => (
  <TooltipProvider>
    <Tooltip>
      <TooltipTrigger>
        <EmotionEmoji
          className={cn("size-9 rounded-lg p-1", className)}
          emotion={
            predictedEmotion.emotion?.class as Parameters<
              typeof EmotionEmoji
            >[0]["emotion"]
          }
        />
      </TooltipTrigger>
      <TooltipContent>
        <div className="p-2">
          <p className="text-base font-bold">Predicted emotion</p>
          <p className="text-sm capitalize">
            Emotion: {predictedEmotion.emotion?.class}
          </p>
          <p className="text-sm capitalize">
            Probability: {(predictedEmotion.probability * 100).toFixed(2)}%
          </p>
        </div>
      </TooltipContent>
    </Tooltip>
  </TooltipProvider>
);

const PostTileSentiment = ({
  predictedSentiment,
  className,
}: PostTileSentimentType) => (
  <TooltipProvider>
    <Tooltip>
      <TooltipTrigger>
        <SentimentEmoji
          className={cn("size-9 rounded-lg p-1", className)}
          sentiment={
            predictedSentiment.sentiment?.class as Parameters<
              typeof SentimentEmoji
            >[0]["sentiment"]
          }
        />
      </TooltipTrigger>
      <TooltipContent>
        <div className="p-2">
          <p className="text-base font-bold">Predicted sentiment</p>
          <p className="text-sm capitalize">
            Sentiment: {predictedSentiment.sentiment?.class}
          </p>
          <p className="text-sm capitalize">
            Probability: {(predictedSentiment.probability * 100).toFixed(2)}%
          </p>
        </div>
      </TooltipContent>
    </Tooltip>
  </TooltipProvider>
);

const PostTilePredictions = ({
  children,
  className,
}: PostTilePredictionsType) => (
  <div className={cn("flex items-center gap-1", className)}>{children}</div>
);

PostTile.Body = PostTileBody;
PostTile.Header = PostTileHeader;
PostTile.Content = PostTileContent;
PostTile.Footer = PostTileFooter;
PostTile.Date = PostTileDate;
PostTile.Emotion = PostTileEmotion;
PostTile.Sentiment = PostTileSentiment;
PostTile.Predictions = PostTilePredictions;
