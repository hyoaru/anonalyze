import { authentication } from "@/services/core-services/authentication";
import { threads } from "@/services/core-services/threads";
import { posts } from "@/services/core-services/posts";
import { threadAnalytics } from "@/services/core-services/threadAnalytics";

export const coreService = {
  authentication,
  threads,
  posts,
  threadAnalytics
}