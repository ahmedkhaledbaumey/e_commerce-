{{-- @if (session()->has("success"))
    <div class="alert alert-">
        {{ session()->get('success') }}
    </div>
@endif   --}}


@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif