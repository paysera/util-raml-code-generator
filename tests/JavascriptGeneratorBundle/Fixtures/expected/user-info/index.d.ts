import { File } from '@paysera/http-client-common';
import { DateTime } from 'luxon';
import { Entity } from '@paysera/http-client-common';

export interface LegalProperties extends UserInfoProperties {
    company_name: string;
    company_code: string;
    vat_code: string | null;
}

declare class Legal extends UserInfo {
    getCompanyName(): string;
    setCompanyName(companyName: string): this;
    getCompanyCode(): string;
    setCompanyCode(companyCode: string): this;
    getVatCode(): string | null;
    setVatCode(vatCode: string | null): this;

    getData(): LegalProperties;
}

export interface NaturalProperties extends UserInfoProperties {
    name: string;
    surname: string;
}

declare class Natural extends UserInfo {
    getName(): string;
    setName(name: string): this;
    getSurname(): string;
    setSurname(surname: string): this;

    getData(): NaturalProperties;
}

export interface UserInfoProperties {
    id: string | null;
    type: string;
    created_timestamp: bigint;
    created_datetime: string | null;
    created_date_only: string | null;
    created_time_only: string | null;
    created_datetime_only: string | null;
}

declare class UserInfo extends Entity {
    getId(): string | null;
    setId(id: string | null): this;
    getType(): string;
    setType(type: string): this;
    getCreatedTimestamp(): bigint;
    setCreatedTimestamp(createdTimestamp: bigint): this;
    getCreatedDatetime(): string | null;
    setCreatedDatetime(createdDatetime: string | null): this;
    getCreatedDateOnly(): string | null;
    setCreatedDateOnly(createdDateOnly: string | null): this;
    getCreatedTimeOnly(): string | null;
    setCreatedTimeOnly(createdTimeOnly: string | null): this;
    getCreatedDatetimeOnly(): string | null;
    setCreatedDatetimeOnly(createdDatetimeOnly: string | null): this;

    getData(): UserInfoProperties;
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

export function createUserInfoClient(configuration: ClientConfiguration): UserInfoClient;

export interface UserInfoClient {
    createLegalUser(legal: Legal): Promise<null>
    createNaturalUser(natural: Natural): Promise<null>
    getUserAvatar(id: string): Promise<File>
    getUserInformation(id: string): Promise<UserInfo>
    updateUserInformation(id: string, userInfo: UserInfo): Promise<UserInfo>
}
