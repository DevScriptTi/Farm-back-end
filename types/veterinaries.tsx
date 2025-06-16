interface VeterinariansResponse {
    status: boolean;
    message: string;
    data: {
        current_page: number;
        data: Veterinarian[];
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
    };
}

interface Veterinarian {
    id: number;
    name: string;
    last: string;
    username: string;
    phone: string;
    email: string;
    academic_degree: string;
    license_number: string;
    clinic_location: string;
    created_at: string;
    updated_at: string;
    baladiya_id: number;
    baladiya: {
        id: number;
        name: string;
        created_at: string;
        updated_at: string;
        wilaya_id: number;
        wilaya: {
            id: number;
            name: string;
            created_at: string;
            updated_at: string;
        };
    };
    key: null;
    photo: null;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface CreateVeterinaryRequest {
    name: string;
    last: string;
    phone: string;
    email: string;
    academic_degree: string;
    license_number: string;
    clinic_location: string;
    mechta_id: number;
}

interface CreateVeterinarySuccessResponse {
    status: boolean;
    message: string;
    data: {
        id: number;
        name: string;
        last: string;
        username: string;
        phone: string;
        email: string;
        academic_degree: string;
        license_number: string;
        clinic_location: string;
        created_at: string;
        updated_at: string;
        baladiya_id: number;
        baladiya: {
            id: number;
            name: string;
            created_at: string;
            updated_at: string;
            wilaya_id: number;
            wilaya: {
                id: number;
                name: string;
                created_at: string;
                updated_at: string;
            };
        };
        key: null;
        photo: null;
    };
}

interface CreateVeterinaryErrorResponse {
    message: string;
    errors: {
        name?: string[];
        last?: string[];
        phone?: string[];
        email?: string[];
        academic_degree?: string[];
        license_number?: string[];
        clinic_location?: string[];
        mechta_id?: string[];
    };
}

interface UpdateVeterinaryRequest {
    name?: string;
    last?: string;
    phone?: string;
    email?: string;
    academic_degree?: string;
    license_number?: string;
    clinic_location?: string;
    mechta_id?: number;
}

interface UpdateVeterinarySuccessResponse {
    status: boolean;
    message: string;
    data: {
        id: number;
        name: string;
        last: string;
        username: string;
        phone: string;
        email: string;
        academic_degree: string;
        license_number: string;
        clinic_location: string;
        created_at: string;
        updated_at: string;
        baladiya_id: number;
        baladiya: {
            id: number;
            name: string;
            created_at: string;
            updated_at: string;
            wilaya_id: number;
            wilaya: {
                id: number;
                name: string;
                created_at: string;
                updated_at: string;
            };
        };
        key: null;
        photo: null;
    };
}

interface UpdateVeterinaryErrorResponse {
    message: string;
    errors: {
        name?: string[];
        last?: string[];
        phone?: string[];
        email?: string[];
        academic_degree?: string[];
        license_number?: string[];
        clinic_location?: string[];
        mechta_id?: string[];
    };
}

export {
    VeterinariansResponse,
    Veterinarian,
    PaginationLink,
    CreateVeterinaryRequest,
    CreateVeterinarySuccessResponse,
    CreateVeterinaryErrorResponse,
    UpdateVeterinaryRequest,
    UpdateVeterinarySuccessResponse,
    UpdateVeterinaryErrorResponse
};