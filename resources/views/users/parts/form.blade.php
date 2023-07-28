<div class="col-6">
    <div class="form-group row">
        <input name="name" type="text" placeholder="Логин" class="form-control" required value="{{ old('name') ?? $user->name ?? '' }}">
    </div>
    <div class="form-group row">
        <input name="email" type="email" placeholder="email" class="form-control" required value="{{ old('email') ?? $user->email ?? '' }}">
    </div>
    <div class="form-group row">
        <input name="password" type="password" placeholder="Пароль" class="form-control" required value="{{ old('password') ?? $user->password ?? '' }}">
    </div>
    {{-- <div class="form-group row">
        <input name="password_confirmation" type="password" placeholder="Пароль" class="form-control" required value="{{ old('password_confirmation') ?? $user->password_confirmation ?? '' }}">
    </div> --}}
</div>