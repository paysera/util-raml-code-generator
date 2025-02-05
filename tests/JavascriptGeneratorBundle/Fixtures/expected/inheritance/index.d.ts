import { Filter } from '@paysera/http-client-common';
import { Entity } from '@paysera/http-client-common';

export interface UserProperties {
    id: string | null;
}

declare class User extends Entity {
    getId(): string | null;
    setId(id: string | null): this;

    getData(): UserProperties;
}

export interface UserBasicProperties extends UserProperties {
    type: string;
}

declare class UserBasic extends User {
    getType(): string;
    setType(type: string): this;

    getData(): UserBasicProperties;
}

export interface UserFilterProperties {
    user_id: bigint | null;
    user_type: string | null;
}

declare class UserFilter extends Filter {
    getUserId(): bigint | null;
    setUserId(userId: bigint | null): this;
    getUserType(): string | null;
    setUserType(userType: string | null): this;

    getData(): UserFilterProperties;
}

export interface UserLegalProperties extends UserProperties {
    company_name: string;
    company_code: string;
    vat_code: string | null;
}

declare class UserLegal extends User {
    getCompanyName(): string;
    setCompanyName(companyName: string): this;
    getCompanyCode(): string;
    setCompanyCode(companyCode: string): this;
    getVatCode(): string | null;
    setVatCode(vatCode: string | null): this;

    getData(): UserLegalProperties;
}

export interface UserLegalFilterProperties extends UserFilterProperties {
    company_name: string | null;
}

declare class UserLegalFilter extends UserFilter {
    getCompanyName(): string | null;
    setCompanyName(companyName: string | null): this;

    getData(): UserLegalFilterProperties;
}

export interface UserNaturalProperties extends UserProperties {
    name: string;
    surname: string;
}

declare class UserNatural extends User {
    getName(): string;
    setName(name: string): this;
    getSurname(): string;
    setSurname(surname: string): this;

    getData(): UserNaturalProperties;
}

export interface UserNaturalFilterProperties {
    first_name: string | null;
    last_name: string | null;
}

declare class UserNaturalFilter extends Entity {
    getFirstName(): string | null;
    setFirstName(firstName: string | null): this;
    getLastName(): string | null;
    setLastName(lastName: string | null): this;

    getData(): UserNaturalFilterProperties;
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

export function createInheritanceClient(configuration: ClientConfiguration): InheritanceClient;

export interface InheritanceClient {
    getUserNatural(userNaturalFilter: UserNaturalFilter): Promise<UserNatural>
    createNaturalUser(userNatural: UserNatural): Promise<UserNatural>
    getUserLegal(userLegalFilter: UserLegalFilter): Promise<UserLegal>
    createLegalUser(userLegal: UserLegal): Promise<UserLegal>
    getUsers(userFilter: UserFilter): Promise<UserBasic[]>
    createUser(userBasic: UserBasic): Promise<UserBasic>
}
