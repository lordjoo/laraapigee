# Company Service

The Company Service exposes methods to create, update, delete, get, list companies, also some other operations related to companies.

## Usage

```php
use \Lordjoo\Apigee\Facades\Apigee;
$companyService = Apigee::edge()->company();
```

### List all companies
Using the `get()` method, you can get a collection of all companies.
```php
$companies = $companyService->get();
```
`$companies` is a Laravel Collection of [Company](#entity) objects.

### Get a company by name
Using the `find()` method, you can get a company by name.
```php
$company = $companyService->find($companyName);
```
`$company` is an instance of [Company](#entity) object.

### Create a company
Using the `create()` method, you can create a company, the `create()` method accepts one parameter `$data`
where `$data` is an array of the company properties [CompanyRequest](https://apidocs.apigee.com/management/apis/post/organizations/%7Borg_name%7D/companies)
```php
$company = $companyService->create($data);
```

### Update a company

Using the `update()` method, you can update a company, the `update()` method accepts two parameters `$companyName` and `$data`
where `$companyName` is the name of the company you want to update
and `$data` is an array of the company properties [CompanyRequest](https://apidocs.apigee.com/management/apis/post/organizations/%7Borg_name%7D/companies)
```php
$company = $companyService->update($companyName, $data);
```

<br>

::: warning Note
The `create` and `update` method will do a validation check on the data you passed, so if you passed an invalid data, the method will throw a validation exception.
:::

### Delete a company
Using the `delete()` method, you can delete a company by it's name.
```php
$companyService->delete($companyName);
```

### Update a company's status
Using the `updateStatus()` method, you can change a company's status by it's name. the `updateStatus()` method accepts two parameters `$companyName` and `$status`
where `$companyName` is the name of the company you want to change the status of
and `$status` is the new status of the company, it can be `active` or `inactive`
```php
$companyService->updateStatus($companyName, $status);
```

## Entity

#### Properties

| Name | Type                               | Description |
| --- |------------------------------------| --- |
| name | string                             | The name of the company |
| displayName | string                             | The display name of the company |
| status | string                             | The status of the company, it can be `active` or `inactive` |
| attributes  | [Attribute[]](/api/edge/attribute) | Attributes of the API Product |
| organization | string                             | The organization that the company belongs to |
| createdAt | string                             | The date and time the company was created in ISO 8601 format |
| lastModifiedAt | string                             | The date and time the company was last modified in ISO 8601 format |
| lastModifiedBy | string                             | The user who last modified the company |

### Methods

#### getApps()
Get a collection of all apps of the company.
```php
$apps = $company->getApps();
```
`$apps` is a Laravel Collection of [CompanyApp](#entity) objects.

#### activate()
Activate the company.
```php
$company->activate();
```

#### deactivate()
Deactivate the company.
```php
$company->deactivate();
```

#### update($data)
Update the company, the `update()` method accepts one parameter `$data`
where `$data` is an array of the company properties [CompanyRequest](https://apidocs.apigee.com/management/apis/post/organizations/%7Borg_name%7D/companies)
```php
$company->update($data);
```

#### delete()
Delete the company.
```php
$company->delete();
```
