import { Entity } from '@paysera/http-client-common';

export interface OrderProperties {
    id: string;
    note: string;
    discount: string | null;
    line: OrderLine | null;
    tags: string[] | null;
    lines: OrderLine[] | null;
}

declare class Order extends Entity {
    getId(): string;
    setId(id: string): this;
    getNote(): string;
    setNote(note: string): this;
    getDiscount(): string | null;
    setDiscount(discount: string | null): this;
    getLine(): OrderLine | null;
    setLine(line: OrderLine | null): this;
    getTags(): string[] | null;
    setTags(tags: string[] | null): this;
    getLines(): OrderLine[] | null;
    setLines(lines: OrderLine[] | null): this;

    getData(): OrderProperties;
}

export interface OrderLineProperties {
    sku: string;
    quantity: bigint;
}

declare class OrderLine extends Entity {
    getSku(): string;
    setSku(sku: string): this;
    getQuantity(): bigint;
    setQuantity(quantity: bigint): this;

    getData(): OrderLineProperties;
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

export function createNullableUnionClient(configuration: ClientConfiguration): NullableUnionClient;

export interface NullableUnionClient {
    createOrder(order: Order): Promise<Order>
}
