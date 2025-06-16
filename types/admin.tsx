interface AdminResponse {
    current_page: number;
    data: Admin[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: PaginationLink[];
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}

interface Admin {
    id: number;
    username: string;
    name: string;
    last: string;
    is_super: "yes" | "no";
    created_at: string;
    updated_at: string;
    key: {
        id: number;
        value: string;
        status: string;
        keyable_type: string;
        keyable_id: number;
        created_at: string;
        updated_at: string;
        user: User | null;
    };
    photo: null;
}

interface User {
    id: number;
    email: string;
    phone: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    key_id: number;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface CreateAdminRequest {
    name: string;
    last: string;
    is_super?: "yes" | "no"; // Optional with default likely being "no"
}

interface CreateAdminSuccessResponse {
    name: string;
    last: string;
    is_super: "yes" | "no";
    username: string;
    updated_at: string;
    created_at: string;
    id: number;
    key: {
        id: number;
        value: string;
        status: string;
        keyable_type: string;
        keyable_id: number;
        created_at: string;
        updated_at: string;
        user: null;
    };
}

interface ErrorResponse {
    message: string;
    errors: {
        name?: string[];
        last?: string[];
        is_super?: string[];
    };
}