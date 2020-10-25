@extends('layouts.master')
@section('heading')
    {{ __('Edit Contact :contact' , ['contact' => '(' . $contact->name. ')']) }}
@stop

@section('content')
    {!! Form::model($contact, [
            'method' => 'PATCH',
            'route' => ['contacts.update', $contact->external_id],
            ]) !!}
    @include('contacts.form', ['submitButtonText' => __('Update contact')])

    {!! Form::close() !!}

@stop