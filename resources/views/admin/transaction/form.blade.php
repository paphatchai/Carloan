<div class="form-group{{ $errors->has('date') ? 'has-error' : ''}}">
    {!! Form::label('date', 'Date', ['class' => 'control-label']) !!}
    {!! Form::date('date', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
    {!! Form::number('status', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('note') ? 'has-error' : ''}}">
    {!! Form::label('note', 'Note', ['class' => 'control-label']) !!}
    {!! Form::textarea('note', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('staff_Id') ? 'has-error' : ''}}">
    {!! Form::label('staff_Id', 'Staff Id', ['class' => 'control-label']) !!}
    {!! Form::number('staff_Id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('staff_Id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('maindata_Id') ? 'has-error' : ''}}">
    {!! Form::label('maindata_Id', 'Maindata Id', ['class' => 'control-label']) !!}
    {!! Form::number('maindata_Id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('maindata_Id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
