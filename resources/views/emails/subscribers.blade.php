@component('mail::message')
# Introduction

Dear {{$email}},

We look forward to communicating more with you. For more information visit our blog.

@component('mail::button', ['url' => 'enter your desired url'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
