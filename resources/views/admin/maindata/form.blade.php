<div class="form-group{{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', 'Code', ['class' => 'control-label']) !!}
    {!! Form::text('code', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('date') ? 'has-error' : ''}}">
    {!! Form::label('date', 'Date', ['class' => 'control-label']) !!}
    {!! Form::input('datetime-local', 'date', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('tel') ? 'has-error' : ''}}">
    {!! Form::label('tel', 'Tel', ['class' => 'control-label']) !!}
    {!! Form::text('tel', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('tel', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'control-label']) !!}
    {!! Form::number('type', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
    {!! Form::text('description', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('generation') ? 'has-error' : ''}}">
    {!! Form::label('generation', 'Generation', ['class' => 'control-label']) !!}
    {!! Form::text('generation', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('generation', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('color') ? 'has-error' : ''}}">
    {!! Form::label('color', 'Color', ['class' => 'control-label']) !!}
    {!! Form::text('color', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('color', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('licenseplate') ? 'has-error' : ''}}">
    {!! Form::label('licenseplate', 'Licenseplate', ['class' => 'control-label']) !!}
    {!! Form::text('licenseplate', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('licenseplate', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('amount') ? 'has-error' : ''}}">
    {!! Form::label('amount', 'Amount', ['class' => 'control-label']) !!}
    {!! Form::number('amount', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('percent') ? 'has-error' : ''}}">
    {!! Form::label('percent', 'Percent', ['class' => 'control-label']) !!}
    {!! Form::number('percent', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('percent', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('interest') ? 'has-error' : ''}}">
    {!! Form::label('interest', 'Interest', ['class' => 'control-label']) !!}
    {!! Form::number('interest', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('interest', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
    {!! Form::text('image', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
