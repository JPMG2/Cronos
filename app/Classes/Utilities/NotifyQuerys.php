<?php

declare(strict_types=1);

namespace App\Classes\Utilities;

use Illuminate\Database\Eloquent\Model;

final class NotifyQuerys
{
    /**
     * Generate a response message after updating a model.
     *
     * This method checks if there are any changes in the model after an update.
     * If changes are detected, it returns a success message. Otherwise, it returns
     * a message indicating no changes were made.
     *
     * @param  Model  $model  The model instance that was updated.
     * @return array The response message indicating the result of the update operation.
     */
    public static function msgUpadte($model): array
    {
        if ($model->getChanges() && count($model->getChanges())) {
            $message = ['Actualización exitosa !!', 1];
        } else {
            $message = ['Sin cambios !!', 0];
        }

        return $message;
    }

    /**
     * Generate a response message after creating a model.
     *
     * This method checks if the model was recently created.
     * If the model was created successfully, it returns a success message.
     * Otherwise, it returns an error message.
     *
     * @param  Model  $model  The model instance that was created.
     * @return array The response message indicating the result of the create operation.
     */
    public static function msgCreate($model): array
    {
        if ($model->wasRecentlyCreated) {
            $message = ['Registro exitoso !!', 1];
        } else {
            $message = ['Error en registro !!', 0];
        }

        return $message;
    }

    /**
     * Generate a response message after creating a relationship.
     *
     * This method checks if a relationship was successfully created between two models.
     * It verifies the existence of the relationship by counting the related records.
     * If the relationship exists, it returns a success message. Otherwise, it returns an error message.
     *
     * @param  array  $relashion  An array containing the models involved in the relationship.
     * @return array The response message indicating the result of the create relationship operation.
     */
    public static function msgCreateUpdateMany(array $relashion): array
    {

        if (! empty($relashion['attached']) || ! empty($relashion['detached'])) {
            $message = ['Registro exitoso !!', 1];
        } else {
            $message = ['Error en registro !!', 0];
        }

        return $message;
    }

    public static function msgDestroy(int $numberDelete): array
    {
        if ($numberDelete > 0) {
            $message = ['Se ha borrado exitosamente !!', 1];
        } else {
            $message = ['No se ha borrado el registro !!', 0];
        }

        return $message;
    }

    public static function msgUpdateCreate($model): array
    {

        if ($model->wasRecentlyCreated) {
            $message = ['Registro exitoso !!', 1];
        } elseif ($model->getChanges() > 0) {
            $message = ['Actualización exitosa !!', 1];
        } else {
            $message = ['Sin cambios !!', 0];
        }

        return $message;
    }
}
