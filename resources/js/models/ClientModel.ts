import { IdAndTimestamp } from "./IdAndTimestamp";

export interface ClientModel extends IdAndTimestamp {
  name: string;
  redirect_urls: string[];
}
