@csrf
<div class="form-group">
    <label for="name">Name</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Example: Avery Jordan" name="name" required
        value="{{ old('name') }}@isset($user){{ $user->name }}@endisset">
    @error('name')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input class="form-control @error('email') is-invalid @enderror" id="text" name="email" placeholder="Example: averyjordan@mail.com" required
    value="{{ old('email') }}@isset($user){{ $user->email }}@endisset">
    @error('email')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

@isset($create)
<div class="form-group">
    <label for="password">Password</label>
    <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="*************" name="password" required="">
    @error('password')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
@endisset

@foreach ($roles as $role)
    <div class="form-check">
        <input class="form-check-input" name="roles[]" type="checkbox" value="{{ $role->id }}" id="{{ $role->name }}"
            @isset($user) @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif @endisset>
        <label for="{{ $role->name }}" class="form-check-label">{{ $role->name }}</label>
    </div>
@endforeach
<br>
<button class="btn btn-block btn-success" type="submit">Submit</button>
<a href="{{ route('admin.users.index') }}" class="btn btn-block btn-primary">Return</a>
