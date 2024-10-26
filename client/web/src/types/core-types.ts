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
