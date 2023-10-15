<div class="row"> 
    <div class="col-md-4"> 
        {!!Form::text("name","Nome")->required()!!} 
    </div>
    <div class="col-md-4"> 
        {!!Form::text("email","Email")->required()!!} 
    </div>
    <div class="col-md-6"> 
    <select name="role_id">
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{ auth()->user()->roles->contains('id', $role->id) ? 'selected' : '' }}>
            {{ $role->name }}
            </option>
        @endforeach
    </select>
    </div>
</div>
<button type="submit" class="btn btn-primary">Enviar</button>