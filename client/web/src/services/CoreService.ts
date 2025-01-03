import { AuthenticationService } from "./core-services/AuthenticationService";
import { PostService } from "./core-services/PostService";
import { ThreadAnalyticService } from "./core-services/ThreadAnalyticService";
import { ThreadService } from "./core-services/ThreadService";

export class CoreService {
  static authentication = AuthenticationService;
  static thread = ThreadService;
  static post = PostService;
  static threadAnalytic = ThreadAnalyticService;
}
