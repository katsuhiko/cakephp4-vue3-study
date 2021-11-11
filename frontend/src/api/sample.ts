import api, { ApiResponse } from "@/clients/api";
import { ErrorCode } from "./types/general/ErrorCode";
import {
  JSONApiResponseBody,
  JSONApiResponseErrorBody,
} from "./types/general/JSONApiResponse";
import {
  SampleApiGetData,
  SampleApiPostData,
  SampleApiPostResult,
} from "./types/SampleApi";

export async function getSample(): Promise<
  | ApiResponse<200, JSONApiResponseBody<SampleApiGetData[]>>
  | ApiResponse<404, JSONApiResponseErrorBody<ErrorCode>>
> {
  return await api.get(`/sample`);
}

export async function postSample(
  postData: SampleApiPostData
): Promise<
  | ApiResponse<200, JSONApiResponseBody<SampleApiPostResult>>
  | ApiResponse<400, JSONApiResponseErrorBody<ErrorCode>>
> {
  return await api.post(`/sample`, postData);
}
