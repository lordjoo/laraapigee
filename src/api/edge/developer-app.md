# Developer App Service
The Developer App Service exposes methods to create, update, delete, get, list developer apps, also some other operations related to developer apps.

## Usage

```php
use \Lordjoo\Apigee\Facades\Apigee;
$developerAppService = Apigee::edge()->developerApp($developerEmail);
```
As you can see, the `developerApp()` method accepts one parameter `$developerEmail` which is the email of the developer you want to work with.


### List all developer apps
Using the `get()` method, you can get a collection of all developer apps of the developer.
```php
$developerApps = $developerAppService->get();
```
`$developerApps` is a Laravel Collection of [DeveloperApp](#entity) objects.


### Get a developer app by name
Using the `find()` method, you can get a developer app by name.
```php
$developerApp = $developerAppService->find($appName);
```
`$developerApp` is an instance of [DeveloperApp](#entity) object.




### Create a developer app
Using the `create()` method, you can create a developer app, the `create()` method accepts one parameter `$data`
where `$data` is an array of the developer app properties [DeveloperAppRequest](https://apidocs.apigee.com/management/apis/post/organizations/%7Borg_name%7D/developers/%7Bdeveloper_email_or_id%7D/apps)
```php
$developerApp = $developerAppService->create($data);
```

### Update a developer app
Using the `update()` method, you can update a developer app, the `update()` method accepts two parameters `$appName` and `$data`
where `$appName` is the name of the developer app you want to update
and `$data` is an array of the developer app properties [DeveloperAppRequest](https://apidocs.apigee.com/management/apis/post/organizations/%7Borg_name%7D/developers/%7Bdeveloper_email_or_id%7D/apps)
```php
$developerApp = $developerAppService->update($appName, $data);
```

<br>

::: warning Note
The `create` and `update` method will do a validation check on the data you passed, so if you passed an invalid data, the method will throw a validation exception.
:::

### Delete a developer app
Using the `delete()` method, you can delete a developer app by it's name.
```php
$developerAppService->delete($appName);
```

### Update a developer app's status
Using the `updateStatus()` method, you can change a developer app's status by it's name. the `updateStatus()` method accepts two parameters `$appName` and `$status`
where `$appName` is the name of the developer app you want to change the status of
and `$status` is the new status of the developer app, either `approved` or `revoked`
```php
$developerAppService->updateStatus($appName, $status);
```

### Create a developer app credential
Using the `createCredential()` method, you can create a developer app credential, the `createCredential()` method accepts two parameters `$appName` and `$data`
where `$appName` is the name of the developer app you want to create a credential for
and `$data` is an array of the credential properties [DeveloperAppCredentialRequest](https://apidocs.apigee.com/management/apis/post/organizations/%7Borg_name%7D/developers/%7Bdeveloper_email_or_id%7D/apps/%7Bapp_name%7D/keys/create)
```php
$developerAppService->createCredential($appName, $data);
```


### Get a developer app credential
Using the `getCredential()` method, you can get a developer app credential by it's name. the `getCredential()` method accepts two parameters `$appName` and `$consumerKey`
where `$appName` is the name of the developer app you want to get the credential of
and `$consumerKey` is the consumer key of the credential you want to get
```php
$developerAppService->getCredential($appName, $consumerKey);
```
`$developerApp` is an instance of [AppKey](#appkey) object.

### Delete a developer app credential
Using the `deleteCredential()` method, you can delete a developer app credential by it's name. the `deleteCredential()` method accepts two parameters `$appName` and `$consumerKey`
where `$appName` is the name of the developer app you want to delete the credential of
and `$consumerKey` is the consumer key of the credential you want to delete
```php
$developerAppService->deleteCredential($appName, $consumerKey);
```

### Add an API Product to a credential
Using the `addProductToCredential()` method, you can add an API Product to a developer app credential. the `addProductToCredential()` method accepts three parameters `$appName`, `$consumerKey` and `$apiProductName`
where `$appName` is the name of the developer app you want to add the product to
and `$consumerKey` is the consumer key of the credential you want to add the product to
and `$apiProductName` is the name of the API Product you want to add to the credential
```php
$developerAppService->addProductToCredential($appName, $consumerKey, $apiProductName);
```

### Remove an API Product from a credential
Using the `removeProductFromCredential()` method, you can remove an API Product from a developer app credential. the `removeProductFromCredential()` method accepts three parameters `$appName`, `$consumerKey` and `$apiProductName`
where `$appName` is the name of the developer app you want to remove the product from
and `$consumerKey` is the consumer key of the credential you want to remove the product from
and `$apiProductName` is the name of the API Product you want to remove from the credential
```php
$developerAppService->removeProductFromCredential($appName, $consumerKey, $apiProductName);
```




## Entity

### DeveloperApp
### Properties

| Property | Type                                      | Description |
| -------- |-------------------------------------------| ----------- |
| name | string                                    | The name of the app. |
| status | string                                    | The status of the app. |
| appFamily | string                                    | The app family. |
| scopes | array                                     | The scopes associated with the app. |
| callbackUrl | string                                    | The callback URL. |
| createdBy | string                                    | The user who created the app. |
| createdAt | [Carbon](https://carbon.nesbot.com/docs/) | The date and time the app was created. |
| lastModifiedBy | string                                    | The user who last modified the app. |
| lastModifiedAt | [Carbon](https://carbon.nesbot.com/docs/) | The date and time the app was last modified. |
| developerId | string                                    | The developer ID. |
| attributes  | [Attribute[]](/api/edge/attribute)        | Attributes of the API Product |
| credentials | [AppKey[]](#appkey)                       | Credentials of the app. |


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

