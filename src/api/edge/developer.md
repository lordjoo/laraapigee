# Developer Service
The Developer Service exposes methods to create, update, delete, get, list developers, also some other operations related to developers.

## Usage

```php
use \Lordjoo\Apigee\Facades\Apigee;
$developerService = Apigee::edge()->developer();
```

### List all developers

Using the `get()` method, you can get a collection of all developers in the organization.
```php
$developers = $developerService->get();
```
`$developers` is a Laravel Collection of [Developer](#entity) objects.

### Get a developer by email

Using the `find()` method, you can get a developer by email.
```php
$developer = $developerService->find($email);
```
`$developer` is an instance of [Developer](#entity) object.

### Create a developer

Using the `create()` method, you can create a developer, the `create()` method accepts one parameter `$data`
where `$data` is an array of the developer properties [DeveloperRequest](https://apidocs.apigee.com/docs/developers/1/types/DeveloperRequest)
```php
$developer = $developerService->create($data);
```

### Update a developer

Using the `update()` method, you can update a developer, the `update()` method accepts two parameters `$email` and `$data`
where `$email` is the email of the developer you want to update
and `$data` is an array of the developer properties [DeveloperRequest](https://apidocs.apigee.com/docs/developers/1/types/DeveloperRequest)
```php
$developer = $developerService->update($email, $data);
```

<br>

::: warning Note
The `create` and `update` method will do a validation check on the data you passed, so if you passed an invalid data, the method will throw a validation exception.
:::

### Delete a developer

Using the `delete()` method, you can delete a developer by it's email.
```php
$developerService->delete($email);
```

### Change a developer's status

Using the `updateStatus()` method, you can change a developer's status by it's email. the `updateStatus()` method accepts two parameters `$email` and `$status`
where `$email` is the email of the developer you want to change the status of
and `$status` is the new status of the developer, either `active` or `inactive`
```php
$developerService->updateStatus($email, $status);
```



## Entity

### Properties

| Property | Type     | Description                        |
| -------- |----------|------------------------------------|
| firstName | string   | First name of the developer        |
| lastName | string   | Last name of the developer         |
| userName | string   | User name of the developer         |
| email | string   | Email of the developer             |
| status | string   | Status of the developer, either active or inactive |
| companies | string[] | Array of companies the developer is associated with |
| organizationName | string | Name of the organization the developer is associated with |
| lastModifiedAt | [Carbon](https://carbon.nesbot.com/docs/) | Date and time the developer was last modified |
| createdAt | [Carbon](https://carbon.nesbot.com/docs/) | Date and time the developer was created |
| createdBy | string | Email of the user who created the developer |
| lastModifiedBy | string | Email of the user who last modified the developer |

### Methods
We also provide some helper methods to make it easier to work with the developer entity

#### getApps()
return a collection of [DeveloperApp]() entities associated with the developer

#### activate()
Update the developer status to `active`
```php
$developer->activate();
```

#### deactivate()
Update the developer status to `inactive`
```php
$developer->deactivate();
```

#### update(array $data)
Update the developer properties, the `$data` parameter is an array of the developer properties [DeveloperRequest](https://apidocs.apigee.com/docs/developers/1/types/DeveloperRequest)
```php
$developer->update($data);
```

#### delete()
Delete the developer
```php
$developer->delete();
```

