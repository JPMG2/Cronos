<?php

namespace App\Classes\Utilities;

class NotifyQuerys
{
    public static function msgUpadte($model): array
    {

        if ($model->getChanges() > 0) {
            $message = ['Actualización exitosa !!', 1];
        } else {
            $message = ['Sin cambios !!', 0];
        }

        return $message;
    }

    public static function msgCreate($model): array
    {

        if ($model->wasRecentlyCreated) {
            $message = ['Registro exitoso !!', 1];
        } else {
            $message = ['Error en registro !!', 0];
        }

        return $message;
    }

    public static function msgCreateMany(array $relashion, string $namerelashion): array
    {
        $result = $relashion[0]->$namerelashion()->get()->where('id', $relashion[1]->id)->count();
        if ($result > 0) {
            $message = ['Registro exitoso !!', 1];
        } else {
            $message = ['Error en registro !!', 0];
        }

        return $message;
    }
}
