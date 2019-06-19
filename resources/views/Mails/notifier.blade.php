@component('mail::message')
# Publish Successful!

{{ $user->name }}, your content has been published.

@component('mail::button', ['url' => url('/content?status=published')])
View published content
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
