@isset($success_message)
    <div class="container">
        <div class="alert alert-success" role="alert">
            {{ $success_message }}
        </div>
    </div>
@endisset

@isset($warning_message)
    <div class="container">
        <div class="alert alert-warning" role="alert">
            {{ $warning_message }}
        </div>
    </div>
@endisset

@isset($danger_message)
    <div class="container">
        <div class="alert alert-danger" role="alert">
            {{ $danger_message }}
        </div>
    </div>
@endisset
