@component('mail::message')
# Team Invitation

Hi there!

{{ $inviterName }} has invited you to join the **{{ $teamName }}** team on {{ config('app.name') }}.
{{ __('If you do not have an account, you may create one by clicking the button below. After creating an account, you may click the invitation acceptance button in this email to accept the team invitation:') }}

@component('mail::button', ['url' => route('register')])
{{ __('Create Account') }}
@endcomponent

{{ __('If you already have an account, you may accept this invitation by clicking the button below:') }}

@component('mail::button', ['url' => $acceptUrl])
{{ __('Accept Invitation') }}
@endcomponent

This invitation link will expire in {{ $expiresAt }}. If you didn't request this invitation, you can safely ignore this email.

If you're having trouble clicking the button, copy and paste this URL into your browser:
{{ $acceptUrl }}

Thanks,
The {{ config('app.name') }} Team

@component('mail::subcopy')
If you're having trouble with this invitation, please contact our support team at [{{ config('mail.support_email') }}](mailto:{{ config('mail.support_email') }})
@endcomponent
@endcomponent
