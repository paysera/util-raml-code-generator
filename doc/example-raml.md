##### Raml directory structure:
```
raml
└───category
    |   api.raml
    |
    └───traits
    |       category-filter.raml
    |       filter.raml
    |       item-200-response.raml
    |
    └───types
    |       category.raml
```

`raml/category/api.raml`:
```yaml
#%RAML 1.0
title: Category API
version: v1
baseUri: https://example.com/category/rest/v1
mediaType: application/json
protocols: [ HTTPS ]

types:
  Category: !include types/category.raml

traits:
  CategoryFilter: !include traits/category-filter.raml
  Filter: !include traits/filter.raml
  hasItem200Response: !include traits/item-200-response.raml

/categories:
  get:
    description: Get categories list
    is:
      - CategoryFilter
      - Filter

  post:
    description: Create category
    is:
      - Category
      - hasItem200Response:
          typeName: Category

  /{id}:
    uriParameters:
      id:
        type: string

    put:
      description: Update category
      is:
        - hasItem200Response:
            typeName: Category

    delete:
      description: Delete category

    /enable:
      put:
        description: Enable category
        is:
          - hasItem200Response:
              typeName: Category

    /disable:
      put:
        description: Disable category
        is:
          - hasItem200Response:
              typeName: Category
```

`raml/category/types/category.raml`
```yaml
#%RAML 1.0 DataType
type: object
displayName: Category object
properties:
  id:
    type: string
    required: false
    description: Object id
  parent_id:
    type: string
    required: false
    description: Category parent id
  name:
    type: string
    required: true
    description: Category title
  status:
    type: string
    enum: ["active", "inactive"]
    required: false
    description: Category status
```

`raml/category/traits/filter.raml`
```yaml
#%RAML 1.0 Trait
usage: Used where Result filtering is provided
description: Standard SQL-style Result filtering
queryParameters:
  limit:
    displayName: limit
    type: integer
    minimum: 1
    maximum: 200
    default: 20
    example: 25
    required: false
  offset:
    displayName: offset
    type: integer
    minimum: 0
    default: 0
    example: 25
    required: false
  order_by:
    displayName: order_by
    type: string
    example: created_at
    required: false
    enum:
      - created_at
  order_direction:
    displayName: order_direction
    type: string
    example: desc
    required: false
    default: desc
    enum:
      - desc
      - asc
```

`raml/category/traits/category-filter.raml`
```yaml
#%RAML 1.0 Trait
usage: Used where Category filtering is provided
description: Category Result filtering
queryParameters:
  parent_id:
    displayName: parent_id
    type: string
    minLength: 1
    example: 123456
    required: false
```

`raml/category/traits/item-200-response.raml`
```yaml
#%RAML 1.0 Trait
responses:
  200:
    description: Item response
    body:
      application/json:
        type: <<typeName>>
```
