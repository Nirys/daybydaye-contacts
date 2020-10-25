<div class="col-sm-3">
    <p class="calm-header">{{ __('Contact details')}}</p>
</div>
<div class="col-sm-9" id="primaryContact">
    <div class="form-group">
        {!! Form::label('client',__('Client').':', ['class' => 'control-label thin-weight']) !!}
    @if(isset($lockedClient))
        {!! 
            Form::text('client_name',  
            $lockedClient->company_name, 
            ['class' => 'form-control','disabled'=>true]) 
        !!}
        {!! Form::hidden('client_id', $lockedClient->id) !!}
    @else
        {!! 
            Form::select('client_id',  
            \App\Models\Client::all()->pluck('company_name','id')->toArray(),
            isset($data['owners']) ? $data['owners'][0]['client_id'] : null, 
            ['class' => 'form-control']) 
        !!}    
    @endif
    </div>

    <div class="form-group">
        {!! Form::label('name', __('Name'). ':', ['class' => 'control-label thin-weight']) !!}
        {!! 
            Form::text('name',  
            isset($data['owners']) ? $data['owners'][0]['name'] : null, 
            ['class' => 'form-control']) 
        !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', __('Email'). ':', ['class' => 'control-label thin-weight']) !!}
        {!! 
            Form::email('email',
            isset($data['email']) ? $data['email'] : null, 
            ['class' => 'form-control']) 
        !!}
    </div>
    <div class="form-inline">
    <div class="form-group col-sm-6 removeleft">
        {!! Form::label('primary_number', __('Primary number'). ':', ['class' => 'control-label thin-weight']) !!}
        {!! 
            Form::text('primary_number',  
            isset($data['phone']) ? $data['phone'] : null, 
            ['class' => 'form-control']) 
        !!}
    </div>

    <div class="form-group col-sm-6 removeleft removeright">
        {!! Form::label('secondary_number', __('Secondary number'). ':', ['class' => 'control-label thin-weight']) !!}
        {!! 
            Form::text('secondary_number',  
            null, 
            ['class' => 'form-control']) 
        !!}
    </div>
</div>
</div>
<hr>
<div class="col-sm-10">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-md btn-brand', 'id' => 'submitClient']) !!}
</div>
<div class="col-sm-2">

</div>