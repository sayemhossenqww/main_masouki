@component('mail::message')

{{ $data['name'] }} <br>
{{ $data['email'] }} <br>
{{ $data['message'] }} <br>

{{ config('app.name') }}
@endcomponent
