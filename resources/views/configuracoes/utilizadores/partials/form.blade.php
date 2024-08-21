<div class="form-group">
    <label for="name">{{__('text.name')}}</label>
    <input type="text" class="form-control" id="name" name="name"
        value="{{ $user->name ?? old('name') }}" placeholder="{{__('text.name')}}" required>
</div>

<div class="form-group">
    <label for="email">{{__('text.email')}}</label>
    <input type="email" class="form-control" id="email" name="email"
        value="{{ $user->email ?? old('email') }}" placeholder="{{__('text.email')}}" required>
</div>

<div class="form-group">
    <label for="password">{{__('text.password')}}</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="{{__('text.password')}}">
</div>

<div class="form-group">
    <label for="password_confirmation">{{__('text.password_confirmation')}}</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{__('text.password_confirmation')}}">
</div>
<!-- /.card-body -->
<div class="mt-4">
    <button type="submit" class="btn btn-primary">{{__('template.submit')}}</button>
</div>