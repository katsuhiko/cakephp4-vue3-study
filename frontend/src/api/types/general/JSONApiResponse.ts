// https://jsonapi.org/format/#document-meta

export type JSONApiResponseBody<TData, TMeta = Record<string, never>> = {
  meta?: TMeta;
  data: TData;
};

export type JSONApiResponseErrorBody<
  TCode extends number | string = number | string
> = {
  errors: {
    code: TCode;
    source?: {
      pointer?: string;
    };
    title?: string;
    detail?: string;
  }[];
};

export type JSONApiResponseErrors = JSONApiResponseErrorBody["errors"];
