<div class="form-group">
    <label for="name">{{__('text.name')}}</label>
    <input type="text" class="form-control" id="name" name="name"  value="{{ $role->name ?? old('name') }}" placeholder="{{__('text.name')}}" required>
  </div>