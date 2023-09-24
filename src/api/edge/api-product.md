# API Product Service
This service provides methods to create, update, delete, get, list API Products.

## Usage

```php
use \Lordjoo\Apigee\Facades\Apigee;
$apiProductService = Apigee::edge()->apiProduct();
```

### List all API Products

Using the `get` method, you can get all API Products in your organization.
```php
$products = $apiProductService->get();
```

```$products``` is a Laravel Collection of [ApiProduct](#entity) objects.

### Get an API Product

Using the `find` method, you can get an API Product by it's name.
```php
$product = $apiProductService->find('my-product');
```
```$product``` is an instance of [ApiProduct](#entity) object.

### Create an API Product

Using the `create` method, you can create an API Product, the create method accepts one parameter `$data` which is an array of the API Product properties [APIProductRequest](https://apidocs.apigee.com/docs/api-products/1/types/APIProductRequest)

```php
$product = $apiProductService->create($data);
```
the returned ```$product``` is an instance of [ApiProduct](#entity) object, we also throw an exception if the API Product is not created successfully.

### Update an API Product

Using the `update` method, you can update an API Product, the update method accepts two parameters `$name` and `$data` where `$name` is the name of the API Product you want to update and `$data` is an array of the API Product properties [APIProductRequest](https://apidocs.apigee.com/docs/api-products/1/types/APIProductRequest)

```php
$product = $apiProductService->update($name, $data);
```


<br>

::: warning Note
The `create` and `update` method will do a validation check on the data you passed, so if you passed an invalid data, the method will throw a validation exception.
:::

### Delete an API Product

Using the `delete` method, you can delete an API Product by it's name.
```php
$apiProductService->delete($name);
```



## Entity

### Properties

| Property | Type                               | Description             |
|------------------------|------------------------------------|-------------------------|
| name                   | string                             | Name of the API Product |
| displayName            | string                             | Display name of the API Product |
| description            | string                             | Description of the API Product |
| approvalType           | string                             | Approval type of the API Product |
| attributes             | [Attribute[]](/api/edge/attribute) | Attributes of the API Product |
| proxies                | string[]                           | Proxies of the API Product |
| environments           | string[]                           | Environments of the API Product |
| apiResources           | string[]                           | API Resources of the API Product |
| quota                  | Quota                              | Quota of the API Product |
| quotaInterval          | string                             | Quota interval of the API Product |
| quotaTimeUnit          | string                             | Quota time unit of the API Product |
| scopes                 | string[]                           | Scopes of the API Product |


### Methods
We also provide some helper methods to make it easier to work with the API Product entity.

#### Update the API Product

Using the `update` method, you can update an API Product, the update method accepts one parameter `$data` which is an array of the API Product properties [APIProductRequest](https://apidocs.apigee.com/docs/api-products/1/types/APIProductRequest)

```php
$product->update($data);
```

#### Delete the API Product
Using the `delete` method, you can delete an API Product.
```php
$product->delete();
```
