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
        <input name="user_id" type="hidden" value="{{ $user->id }}">
    </div> --}}

    <div class="form-group row">
        <label for="role">Роль</label>
        
        <select name="role" id="role" class="form-control">
            @foreach ($roles as $id => $role)
            <option value="{{ $id }}" {{
                ($user) ?
                    ($id == $user->role || old('role') ? 'selected' : '')
                :
                    $id == old('role') || old('role') ? 'selected' : ''
            }}>
            {{-- <option value="{{ $id }}" {{ old('role') == $user->role || old('role') ? 'selected' : '' }}> --}}
            {{ $role }}
            </option>
            @endforeach
        </select>
    </div>   
    {{-- <div class="form-group row">
        <input name="password_confirmation" type="password" placeholder="Пароль" class="form-control" required value="{{ old('password_confirmation') ?? $user->password_confirmation ?? '' }}">
    </div> --}}
</div>