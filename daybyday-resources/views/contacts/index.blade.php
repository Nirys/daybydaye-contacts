@extends('layouts.datatable')

@section('heading')
Contacts
@endsection

@section('content')
<table class="table table-hover" id="datatable-table">
        <thead>
        <tr>
            <th>{{ __('Company') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Phone') }}</th>
            <th class="action-header"></th>
            <th class="action-header"></th>
            <th class="action-header"></th>
        </tr>
        </thead>
    </table>
@endsection

@section('columns')
[                
                {data: 'companynamelink', name: 'companynamelink'},
                {data: 'namelink', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'primary_number', name: 'primary_number'},

                { data: 'view', name: 'view', orderable: false, searchable: false, class:'fit-action-delete-th table-actions'},

                @if(Entrust::can('client-update'))
                { data: 'edit', name: 'edit', orderable: false, searchable: false, class:'fit-action-delete-th table-actions'},
                @endif
                @if(Entrust::can('client-delete'))
                { data: 'delete', name: 'delete', orderable: false, searchable: false, class:'fit-action-delete-th table-actions'},
                @endif

]
@endsection