import { paths, components } from "@/types/generated/core-api-schema";

/**
 * Types related to authentication requests and responses.
 * These are organized by request and response for each endpoint.
 */
export type Authentication = {
  Request: {
    SignIn: paths["/api/auth/sign-in"]["post"]["requestBody"]["content"]["application/json"];
    SignUp: paths["/api/auth/sign-up"]["post"]["requestBody"]["content"]["application/json"];
    SignOut: paths["/api/auth/sign-out"]["post"]["requestBody"];
    GetAuthenticatedUser: paths["/api/account"]["get"]["requestBody"];
  };
  Response: {
    SignIn: paths["/api/auth/sign-in"]["post"]["responses"]["200"]["content"]["application/json"];
    SignUp: paths["/api/auth/sign-up"]["post"]["responses"]["200"]["content"]["application/json"];
    SignOut: paths["/api/auth/sign-out"]["post"]["responses"]["200"]["content"]["application/json"];
    GetAuthenticatedUser: paths["/api/account"]["get"]["responses"]["200"]["content"]["application/json"];
  };
};

/**
 * Types related to threads requests and responses.
 * These are organized by request and response for each endpoint.
 */
export type Threads = {
  Request: {
    GetAllByAuthenticatedUser: paths["/api/threads"]["get"]["requestBody"];
    GetById: paths["/api/threads/{id}"]["get"]["parameters"]["path"];
    Store: paths["/api/threads"]["post"]["requestBody"]["content"]["application/json"];
    Update: paths["/api/threads/{id}"]["put"]["parameters"]["path"] &
      paths["/api/threads/{id}"]["put"]["requestBody"]["content"]["application/json"];
    Destroy: paths["/api/threads/{id}"]["delete"]["parameters"]["path"];
  };
  Response: {
    GetAllByAuthenticatedUser: paths["/api/threads"]["get"]["responses"]['200']['content']['application/json'];
    GetById: paths["/api/threads/{id}"]["get"]["responses"]["200"]['content']['application/json'];
    Store: paths["/api/threads"]["post"]["responses"]['201']['content']['application/json']
    Update: paths["/api/threads/{id}"]["put"]["responses"]["200"]['content']['application/json']
    Destroy: paths["/api/threads/{id}"]["delete"]["responses"]["200"]['content']['application/json'];
  }
};

/**
 * Types related to posts requests and responses.
 * These are organized by request and response for each endpoint.
 */
export type Posts = {
  Request: {
    GetById: paths["/api/posts/{id}"]["get"]["parameters"]["path"];
    Store: paths["/api/posts"]["post"]["requestBody"]["content"]["application/json"];
    Destroy: paths["/api/posts/{id}"]["delete"]["parameters"]["path"];
  };
  Response: {
    GetById: paths["/api/posts/{id}"]["get"]["responses"]["200"]['content']['application/json'];
    Store: paths["/api/posts"]["post"]["responses"]['201']['content']['application/json']
    Destroy: paths["/api/posts/{id}"]["delete"]["responses"]["200"]['content']['application/json'];
  }
};

/**
 * Types related to thread analytics requests and responses.
 * These are organized by request and response for each endpoint.
 */
export type ThreadAnalytics = {
  Request: {
    GetById: paths["/api/thread-analytics/{id}"]["get"]["parameters"]["path"];
    Destroy: paths["/api/thread-analytics/{id}"]["delete"]["parameters"]["path"];
    GetThreadAnalyticMetrics: paths["/api/threads/{id}/thread-analytics/metrics"]["get"]["parameters"]["path"];
  };
  Response: {
    GetById: paths["/api/thread-analytics/{id}"]["get"]["responses"]["200"]['content']['application/json'];
    Destroy: paths["/api/thread-analytics/{id}"]["delete"]["responses"]["200"]['content']['application/json'];
    GetThreadAnalyticMetrics: paths["/api/threads/{id}/thread-analytics/metrics"]["get"]["responses"]["200"]['content']['application/json'];
  }
};

/**
 * Core user schema type.
 * Represents a user in the system, with properties defined in the OpenAPI schema.
 */
export type User = components["schemas"]["User"];

/**
 * Types related to thread data and related schemas.
 * These represent the structure and data fields for threads, summaries, analytics, and concept groups.
 */
export type Thread = components["schemas"]["Thread"];
export type ThreadSummary = components["schemas"]["ThreadSummary"];
export type ThreadAnalytic = components["schemas"]["ThreadAnalytic"];
export type ThreadExtractedConcept =
  components["schemas"]["ThreadExtractedConcept"];
export type ThreadExtractedConceptGroup =
  components["schemas"]["ThreadExtractedConceptGroup"];

/**
 * Types for posts and associated analytics, sentiments, and emotions.
 * These types are useful for representing post data and prediction models.
 */
export type Post = components["schemas"]["Post"];
export type PostAnalytic = components["schemas"]["PostAnalytic"];
export type PostPredictedEmotion =
  components["schemas"]["PostPredictedEmotion"];
export type PostPredictedSentiment =
  components["schemas"]["PostPredictedSentiment"];

/**
 * Core sentiment and emotion types.
 * Represents sentiment and emotion schemas as defined in the OpenAPI schema.
 */
export type Sentiment = components["schemas"]["Sentiment"];
export type Emotion = components["schemas"]["Emotion"];
