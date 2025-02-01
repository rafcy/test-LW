export interface FormErrors {
    full_name?: string;
    email?: string;
    [key: string]: string | undefined;
}
