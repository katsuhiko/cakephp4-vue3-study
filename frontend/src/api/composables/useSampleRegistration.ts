import { SampleFoundation } from "@/model/SampleFoundation";
import { postSample } from "../sample";

export default function (sampleFoundation: SampleFoundation) {
  return {
    registered: (async () => {
      const res = await postSample(sampleFoundation);

      switch (res.status) {
        case 200:
          return res.data.data.sample_id;
        case 400:
          break;
        default: {
          res;
        }
      }
    })(),
  };
}
