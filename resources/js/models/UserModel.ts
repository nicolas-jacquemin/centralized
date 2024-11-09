import { ClientModel } from "./ClientModel";
import { IdAndTimestamp } from "./IdAndTimestamp";

export interface UserModel extends IdAndTimestamp {
  name: string;
  email: string;
  active_client_sessions: ClientModel[];
}
