import { UserModel } from "@/models/UserModel";

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: UserModel;
        csrf_token: string;
    };
};
