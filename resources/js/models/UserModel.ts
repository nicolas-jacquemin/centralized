import { ClientModel } from "./ClientModel";
import { IdAndTimestamp } from "./IdAndTimestamp";

export interface UserModel extends IdAndTimestamp {
  name: string;
  email: string;
  email_verified_at: string;
  active_client_sessions: ClientModel[];
  clients: ClientModel[];
  role: string;
}
