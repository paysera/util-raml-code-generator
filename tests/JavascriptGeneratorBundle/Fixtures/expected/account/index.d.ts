import { Filter } from '@paysera/http-client-common';
import { Result } from '@paysera/http-client-common';
import { DateTime } from 'luxon';
import { Entity } from '@paysera/http-client-common';

export interface AccountProperties {
    created_at: bigint;
    number: string;
    active: boolean;
    client_id: bigint;
    closed: boolean;
    type: string;
    undescribed: UndescribedType;
    public: boolean | null;
}

declare class Account extends Entity {
    getCreatedAt(): bigint;
    setCreatedAt(createdAt: bigint): this;
    getNumber(): string;
    setNumber(number: string): this;
    isActive(): boolean;
    setActive(active: boolean): this;
    getClientId(): bigint;
    setClientId(clientId: bigint): this;
    isClosed(): boolean;
    setClosed(closed: boolean): this;
    getType(): string;
    setType(type: string): this;
    getUndescribed(): UndescribedType;
    setUndescribed(undescribed: UndescribedType): this;
    isPublic(): boolean | null;
    setPublic(_public: boolean | null): this;

    getData(): AccountProperties;
}

export interface AccountFilterProperties {
    type: string | null;
    administered_by_user_id: bigint | null;
    owned_by_user_id: bigint | null;
    closed: boolean | null;
    readable_by_client_id: bigint | null;
    active: boolean | null;
}

declare class AccountFilter extends Filter {
    getType(): string | null;
    setType(type: string | null): this;
    getAdministeredByUserId(): bigint | null;
    setAdministeredByUserId(administeredByUserId: bigint | null): this;
    getOwnedByUserId(): bigint | null;
    setOwnedByUserId(ownedByUserId: bigint | null): this;
    isClosed(): boolean | null;
    setClosed(closed: boolean | null): this;
    getReadableByClientId(): bigint | null;
    setReadableByClientId(readableByClientId: bigint | null): this;
    isActive(): boolean | null;
    setActive(active: boolean | null): this;

    getData(): AccountFilterProperties;
}

export interface AccountResultProperties {
}

declare class AccountResult extends Result {

    getData(): AccountResultProperties;
}

export interface UndescribedTypeProperties {
    age: bigint;
    name: string;
}

declare class UndescribedType extends Entity {
    getAge(): bigint;
    setAge(age: bigint): this;
    getName(): string;
    setName(name: string): this;

    getData(): UndescribedTypeProperties;
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

export function createAccountClient(configuration: ClientConfiguration): AccountClient;

export interface AccountClient {
    getAccountScripts(): Promise<string>
    getAccounts(accountFilter: AccountFilter): Promise<AccountResult>
}
