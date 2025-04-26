@props(['user','width' => 90])

<img src="{{ asset($user->logo) }}" alt="User avatar" class="rounded-xl" width={{ $width }}>
