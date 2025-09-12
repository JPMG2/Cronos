<?php

declare(strict_types=1);

use App\Classes\Services\ModelService;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

uses(RefreshDatabase::class);

describe('ModelsQuerys', function () {
    beforeEach(function () {
        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        $this->service = new ModelService(new User);
    });

    describe('show method', function () {
        it('finds a model by id successfully', function () {
            $result = $this->service->show($this->user->id);
            
            expect($result)->toBeInstanceOf(User::class)
                ->and($result->id)->toBe($this->user->id)
                ->and($result->email)->toBe('test@example.com');
        });

        it('throws ModelNotFoundException when model not found', function () {
            expect(fn () => $this->service->show(999))
                ->toThrow(ModelNotFoundException::class);
        });
    });

    describe('store method', function () {
        it('creates a new model successfully', function () {
            $data = [
                'name' => 'New User',
                'email' => 'newuser@example.com',
                'password' => 'password123',
            ];

            $result = $this->service->store($data);

            expect($result)->toBeInstanceOf(User::class)
                ->and($result->name)->toBe('New User')
                ->and($result->email)->toBe('newuser@example.com');

            $this->assertDatabaseHas('users', [
                'email' => 'newuser@example.com',
                'name' => 'New User',
            ]);
        });

        it('filters data based on model fillable attributes', function () {
            $data = [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'password123',
                'non_fillable_field' => 'should_be_ignored',
            ];

            $result = $this->service->store($data);

            expect($result)->toBeInstanceOf(User::class)
                ->and($result->name)->toBe('Test User');
        });
    });

    describe('update method', function () {
        it('updates an existing model successfully', function () {
            $updateData = [
                'name' => 'Updated Name',
                'email' => 'updated@example.com',
            ];

            $result = $this->service->update($updateData, $this->user->id);

            expect($result)->toBeInstanceOf(User::class)
                ->and($result->name)->toBe('Updated Name')
                ->and($result->email)->toBe('updated@example.com');

            $this->assertDatabaseHas('users', [
                'id' => $this->user->id,
                'name' => 'Updated Name',
                'email' => 'updated@example.com',
            ]);
        });

        it('throws ModelNotFoundException when updating non-existent model', function () {
            $updateData = ['name' => 'Updated Name'];

            expect(fn () => $this->service->update($updateData, 999))
                ->toThrow(ModelNotFoundException::class);
        });
    });

    describe('transaction handling', function () {
        it('handles transaction rollback on error', function () {
            // Create a mock that will throw an exception
            $mockModel = mock(User::class)->makePartial();
            $mockModel->shouldReceive('create')->andThrow(new \Exception('Database error'));
            
            $service = new ModelService($mockModel);

            expect(fn () => $service->store(['name' => 'Test']))
                ->toThrow(\Exception::class);
        });
    });

    describe('error handling', function () {
        it('handles errors properly with abort', function () {
            // Test the protected handleError method by triggering a condition that calls it
            expect(function () {
                $mockModel = mock(User::class)->makePartial();
                $service = new ModelService($mockModel);
                
                // Use reflection to call protected method
                $reflection = new ReflectionClass($service);
                $method = $reflection->getMethod('handleError');
                $method->setAccessible(true);
                $method->invoke($service, 'Test error message');
            })->toThrow(HttpException::class);
        });
    });
});