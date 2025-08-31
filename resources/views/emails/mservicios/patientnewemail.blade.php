<x-mail::message>
# Bienvenido.

¡Hola, {{$patient->person->fullName}} !

Te damos la bienvenida a nuestro sistema de atención. Nos alegra contar contigo como parte de nuestra comunidad.

A partir de ahora, podrás acceder a tus datos médicos, gestionar tus citas, y recibir atención personalizada de
manera fácil y segura.

Si tenés dudas o necesitás ayuda, no dudes en contactarnos.

¡Gracias por confiar en nosotros!

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>
