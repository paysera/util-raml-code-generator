import { Entity } from '@paysera/http-client-common';

export interface InquiryProperties {
    id: string;
    question: string;
    comment: string | null;
    fulfilled: boolean | null;
    reviewed_at: string | null;
    reviewer: Reviewer | null;
}

declare class Inquiry extends Entity {
    getId(): string;
    setId(id: string): this;
    getQuestion(): string;
    setQuestion(question: string): this;
    getComment(): string | null;
    setComment(comment: string | null): this;
    isFulfilled(): boolean | null;
    setFulfilled(fulfilled: boolean | null): this;
    getReviewedAt(): string | null;
    setReviewedAt(reviewedAt: string | null): this;
    getReviewer(): Reviewer | null;
    setReviewer(reviewer: Reviewer | null): this;

    getData(): InquiryProperties;
}

export interface ReviewerProperties {
    user_id: string;
    display_name: string;
}

declare class Reviewer extends Entity {
    getUserId(): string;
    setUserId(userId: string): this;
    getDisplayName(): string;
    setDisplayName(displayName: string): this;

    getData(): ReviewerProperties;
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

export function createNullableTypesClient(configuration: ClientConfiguration): NullableTypesClient;

export interface NullableTypesClient {
    getInquiry(id: string): Promise<Inquiry>
    updateInquiry(id: string, inquiry: Inquiry): Promise<Inquiry>
}
