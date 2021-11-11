export type ErrorCode =
  | typeof VALUE_IS_TOO_SHORT
  | typeof WEAK_PASSWORD
  | typeof PASSWORD_CONFIRMATION_NOT_MATCH;

export const VALUE_IS_TOO_SHORT = "123";
export const WEAK_PASSWORD = "225";
export const PASSWORD_CONFIRMATION_NOT_MATCH = "226";
