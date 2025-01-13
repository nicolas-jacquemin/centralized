import { IdAndTimestamp } from "./IdAndTimestamp";

export interface ClientModel extends IdAndTimestamp {
  name: string;
  picture: string;
  redirect_urls: string[];
}
