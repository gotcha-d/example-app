@component('mail::message')

# 新しいユーザーが追加されました

{{ $toUser->name  }}さん、こんにちは！

新しく{{ $newUser->name }}さんが参加しました。

@endcomponent