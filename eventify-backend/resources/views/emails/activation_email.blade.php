@component('mail::message')
# Your account has been activated

Hello {{ $user->name }},
this email has been sent to you to notify the activation of your Eventify account.

You can now log in to your account.

If you did not create an account, someone could have created an account with your email address.

Thanks,<br>
<strong>Eventify</strong>
@endcomponent