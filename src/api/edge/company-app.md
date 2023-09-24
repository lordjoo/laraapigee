# Company App Service
The Company App Service exposes methods to create, update, delete, get, list company apps, also some other operations related to company apps.


## Usage

```php
use \Lordjoo\Apigee\Facades\Apigee;
$companyAppService = Apigee::edge()->companyApp($companyName);
```
As you can see, the `companyApp()` method accepts one parameter `$companyName` which is the name of the company you want to work with.


### List all company apps
Using the `get()` method, you can get a collection of all company apps of the company.
```php
$companyApps = $companyAppService->get();
```
`$companyApps` is a Laravel Collection of [CompanyApp](#entity) objects.


### Get a company app by name
Using the `find()` method, you can get a company app by name.
```php
$companyApp = $companyAppService->find($appName);
```
`$companyApp` is an instance of [CompanyApp](#entity) object.


### Create a company app
Using the `create()` method, you can create a company app, the `create()` method accepts one parameter `$data`
where `$data` is an array of the company app properties [CompanyAppRequest](https://apidocs.apigee.com/management/apis/post/organizations/%7Borg_name%7D/companies/%7Bcompany_name%7D/apps)
```php
$companyApp = $companyAppService->create($data);
```

### Update a company app
Using the `update()` method, you can update a company app, the `update()` method accepts two parameters `$appName` and `$data`
where `$appName` is the name of the company app you want to update
and `$data` is an array of the company app properties [CompanyAppRequest](https://apidocs.apigee.com/management/apis/post/organizations/%7Borg_name%7D/companies/%7Bcompany_name%7D/apps)
```php
$companyApp = $companyAppService->update($appName, $data);
```

<br>

::: warning Note
The `create` and `update` method will do a validation check on the data you passed, so if you passed an invalid data, the method will throw a validation exception.
:::

### Delete a company app
Using the `delete()` method, you can delete a company app by it's name.
```php
$companyAppService->delete($appName);
```

### Update a company app's status

Using the `updateStatus()` method, you can change a company app's status by it's name. the `updateStatus()` method accepts two parameters `$appName` and `$status`
where `$appName` is the name of the company app you want to change the status of
and `$status` is the new status of the company app, it can be `active` or `inactive`
```php
$companyAppService->updateStatus($appName, $status);
```

## Entity
### Properties

| Property | Type                                      | Description |
| -------- |-------------------------------------------| ----------- |
| name | string                                    | The name of the app. |
| companyName | string                                    | The name of the company. |
| status | string                                    | The status of the app. |
| appFamily | string                                    | The app family. |
| scopes | array                                     | The scopes associated with the app. |
| callbackUrl | string                                    | The callback URL. |
| createdBy | string                                    | The user who created the app. |
| lastModifiedBy | string                                    | The user who last modified the app. |
| developerId | string                                    | The developer ID. |
| attributes  | [Attribute[]](/api/edge/attribute)        | Attributes of the API Product |
| credentials | [AppKey[]](#appkey)                       | Credentials of the app. |
| createdAt | [Carbon](https://carbon.nesbot.com/docs/) | The date and time the app was created. |
| lastModifiedAt | [Carbon](https://carbon.nesbot.com/docs/) | The date and time the app was last modified. |

## AppKey
### Properties

| Property | Type                                      | Description |
| -------- |-------------------------------------------| ----------- |
| consumerKey | string                                    | The consumer key. |
| consumerSecret | string                                    | The consumer secret. |
| expiresAt | [Carbon](https://carbon.nesbot.com/docs/) | The date and time the credential expires. |
| issuedAt | [Carbon](https://carbon.nesbot.com/docs/) | The date and time the credential was issued. |
| scopes | array                                     | The scopes associated with the credential. |
| apiProducts | array                                     | The API products associated with the credential. |
| status | string                                    | The status of the credential. |
| appName | string                                    | The name of the app. |
| companyName | string  (nullable)                        | The name of the company. |
| developerId | string  (nullable)                        | The developer ID. |


### Methods

#### approve()
Approve the developer app.
```php
$developerApp->approve();
```

#### revoke()
Revoke the developer app.
```php
$developerApp->revoke();
```

