# ModelsQuerys Usage Examples

## Basic CRUD Operations

### Creating a Service Instance

```php
// Method 1: Using dependency injection through service container
$service = app()->make(ModelService::class, ['model' => new User]);

// Method 2: Direct instantiation
$service = new ModelService(new User);
```

### Create Operation

```php
$userData = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => Hash::make('password'),
];

$user = $service->store($userData);
```

### Read Operation

```php
// Find by ID
$user = $service->show(1);

// Find with relationship
$user = $service->showWithRelationship(1, 'showDataRelashion');
```

### Update Operation

```php
$updateData = [
    'name' => 'Jane Doe',
    'email' => 'jane@example.com',
];

$user = $service->update($updateData, 1);
```

## Advanced Relationship Operations

### Create Parent with Child Data

```php
$parentData = [
    'company_name' => 'ACME Corp',
    'company_code' => 'ACME001',
];

$childData = [
    'branch_name' => 'Main Branch',
    'branch_address' => '123 Main St',
];

$company = $service->createAndAssociate($parentData, $childData, 'branches');
```

### Update Parent and Child Together

```php
$updatedParentData = [
    'company_name' => 'ACME Corporation',
];

$updatedChildData = [
    'branch_name' => 'Headquarters',
];

$company = $service->updateAndAssociate(1, $updatedParentData, $updatedChildData, 'branches');
```

## Integration with Livewire Forms

### Complete Form Example

```php
<?php

namespace App\Livewire\Forms\Example;

use App\Classes\Services\ModelService;
use App\Classes\Validation\UserValidation;
use App\Models\User;
use Livewire\Form;

final class UserForm extends Form
{
    public array $userData = [
        'name' => '',
        'email' => '',
        'password' => '',
    ];

    public function userStore(UserValidation $validation): array
    {
        $service = $this->getUserService();
        $validatedData = $validation->validateCreate($this->userData);
        
        $user = $service->store($validatedData);
        
        return [
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ];
    }

    public function userUpdate(UserValidation $validation, int $userId): array
    {
        $service = $this->getUserService();
        $validatedData = $validation->validateUpdate($this->userData);
        
        $user = $service->update($validatedData, $userId);
        
        return [
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ];
    }

    public function loadUser(int $userId): void
    {
        $service = $this->getUserService();
        $user = $service->show($userId);
        
        $this->userData = $user->toArray();
    }

    private function getUserService(): ModelService
    {
        return app()->make(ModelService::class, ['model' => new User]);
    }
}
```

## Error Handling Examples

### Handling ModelNotFoundException

```php
use Illuminate\Database\Eloquent\ModelNotFoundException;

try {
    $user = $service->show(999); // Non-existent ID
} catch (ModelNotFoundException $e) {
    // Handle case where model doesn't exist
    return response()->json(['error' => 'User not found'], 404);
}
```

### Transaction Rollback

```php
// The service automatically handles transaction rollbacks
// If any operation in createAndAssociate fails, everything is rolled back
try {
    $result = $service->createAndAssociate($parentData, $childData, 'relationship');
} catch (\Exception $e) {
    // Check logs for detailed error information
    Log::error('Failed to create with association: ' . $e->getMessage());
}
```

## Testing Examples

### Unit Test for Service

```php
use App\Classes\Services\ModelService;
use App\Models\User;

it('creates a user successfully', function () {
    $service = new ModelService(new User);
    
    $userData = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
    ];

    $user = $service->store($userData);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->name)->toBe('Test User')
        ->and($user->email)->toBe('test@example.com');
        
    assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'name' => 'Test User',
    ]);
});
```

### Testing Livewire Component with Service

```php
use App\Livewire\Forms\Example\UserForm;
use Livewire\Livewire;

it('creates user through livewire form', function () {
    Livewire::test(UserForm::class)
        ->set('userData.name', 'John Doe')
        ->set('userData.email', 'john@example.com')
        ->set('userData.password', 'password123')
        ->call('userStore')
        ->assertSuccessful();
        
    assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
});
```

## Performance Considerations

### Eager Loading with Relationships

```php
// When using showWithRelationship, make sure your model method
// implements proper eager loading to avoid N+1 queries

public function showData(int $id, string $relationName): ?Model
{
    return static::with(['profile', 'roles', 'permissions'])
        ->find($id);
}
```

### Bulk Operations

```php
// For bulk operations, consider using the service in a loop
// with proper transaction handling

DB::transaction(function () use ($dataArray) {
    $service = new ModelService(new User);
    
    foreach ($dataArray as $userData) {
        $service->store($userData);
    }
});
```