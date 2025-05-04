<x-mail::message>
# Bienvenido.

¡Hola,  {{$patient->fullName}} ! 

Queríamos informarte que hemos actualizado correctamente tus datos personales en nuestro sistema.

Mantener tu información actualizada nos ayuda a brindarte una atención más eficiente y personalizada.
Recordá que podés revisar y modificar tus datos siempre que lo necesites desde tu perfil.

Si tenés alguna duda o detectás algo incorrecto, no dudes en comunicarte con nosotros.

¡Gracias por confiar en nosotros!

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>
