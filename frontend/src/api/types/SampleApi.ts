import { Sample } from "@/model/Sample";
import { SampleFoundation } from "@/model/SampleFoundation";

export type SampleApiGetData = Sample;

export type SampleApiPostData = SampleFoundation;

export type SampleApiPostResult = {
  sample_id: string;
};
