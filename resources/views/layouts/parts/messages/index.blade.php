@if ($errors->any())
@foreach ($errors->all() as $error)
    @include('layouts.parts.messages.errors')
@endforeach
@endif

@if (session('success'))
    @include('layouts.parts.messages.success')
@endif
