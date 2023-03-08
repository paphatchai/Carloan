<div class="form-group{{ $errors->has('maindata_id') ? 'has-error' : ''}}">
    {!! Form::label('maindata_id', 'Maindata Id', ['class' => 'control-label']) !!}
    {!! Form::number('maindata_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('maindata_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('node') ? 'has-error' : ''}}">
    {!! Form::label('node', 'Node', ['class' => 'control-label']) !!}
    {!! Form::textarea('node', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('node', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('action') ? 'has-error' : ''}}">
    {!! Form::label('action', 'Action', ['class' => 'control-label']) !!}
    {!! Form::text('action', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('action', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('staff_id') ? 'has-error' : ''}}">
    {!! Form::label('staff_id', 'Staff Id', ['class' => 'control-label']) !!}
    {!! Form::number('staff_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('staff_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
