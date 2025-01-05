import { AuthenticationService } from "./core-services/AuthenticationService";
import { AccountService } from "./core-services/AccountService";
import { PostService } from "./core-services/PostService";
import { ThreadAnalyticService } from "./core-services/ThreadAnalyticService";
import { ThreadService } from "./core-services/ThreadService";
import { ThreadSummaryService } from "./core-services/ThreadSummaryService";

export class CoreService {
  static authentication = AuthenticationService;
  static account = AccountService;
  static thread = ThreadService;
  static post = PostService;
  static threadAnalytic = ThreadAnalyticService;
  static threadSummary = ThreadSummaryService;
}
