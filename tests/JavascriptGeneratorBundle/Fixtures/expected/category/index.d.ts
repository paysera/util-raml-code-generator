import { Filter } from '@paysera/http-client-common';
import { Entity } from '@paysera/http-client-common';

interface CategoryProperties {
    id: string | null;
    photo: string;
    avatar: string | null;
    parent_id: string | null;
    titles: string[];
    status: string | null;
    private: boolean;
}

export interface Category extends Entity {
    getId(): string | null;
    setId(id: string | null): this;
    getPhoto(): string;
    setPhoto(photo: string): this;
    getAvatar(): string | null;
    setAvatar(avatar: string | null): this;
    getParentId(): string | null;
    setParentId(parentId: string | null): this;
    getTitles(): string[];
    setTitles(titles: string[]): this;
    getStatus(): string | null;
    setStatus(status: string | null): this;
    isPrivate(): boolean;
    setPrivate(_private: boolean): this;

    getData(): CategoryProperties;
}

interface CategoryFilterProperties {
    parent_id: string | null;
}

export interface CategoryFilter extends Filter {
    getParentId(): string | null;
    setParentId(parentId: string | null): this;

    getData(): CategoryFilterProperties;
}


interface ClientConfigurationOptions {
    urlParameters?: {
        [key: string]: string,
    },
    [key: string]: any,
}

interface ClientConfiguration {
    baseURL: string,
    middleware?: object[],
    options?: ClientConfigurationOptions
}

export function createCategoryClient(configuration: ClientConfiguration): CategoryClient;

export interface CategoryClient {
    enableCategory(id: string): Promise<Category>
    disableCategory(id: string): Promise<Category>
    updateCategory(id: string): Promise<Category>
    deleteCategory(id: string): Promise<null>
    getCategories(categoryFilter: CategoryFilter): Promise<null>
    createCategory(category: Category): Promise<Category>
    getKeywords(filter: Filter): Promise<null>
}
