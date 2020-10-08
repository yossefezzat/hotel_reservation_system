@component('mail::message')
# Introduction

The body of your message.

Reservation for {{$name}} to {{ config('app.name') }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
