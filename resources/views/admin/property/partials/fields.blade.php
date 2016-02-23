<div class="form-group">
 	{!! Form::label('name', 'Property Name') !!}
 	{!! Form::text('name', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('info', 'Description') !!}
 	{!! Form::text('info', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('logo', 'Logo') !!}
 	@if(isset($data['property']) && $data['property']->logo !== null)
 		<img alt="" src="{{asset($data['property']->logo->url)}}">
 	@endif 	
 	{!! Form::file('logo', ['class' => 'form-control']) !!}	 	
    
</div>

<div class="form-group">
 	{!! Form::label('address', 'Address') !!}
 	{!! Form::text('address', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('time_zone', 'Timezone') !!}
 	{!! Form::select('time_zone', config('options.timezones') ,null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('currency', 'Currency') !!}
 	{!! Form::select('currency', $data['currencies'] ,null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('lang', 'Language') !!}
 	{!! Form::select('lang', $data['langs'] ,null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('email', 'Address') !!}
 	{!! Form::email('email', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('text-alignment', 'Timezone') !!}
 	{!! Form::select('text-alignment', config('options.text-alignments') ,null, ['class' => 'form-control']) !!}	 	
    
</div>
