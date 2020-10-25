@extends('layouts.master')
@section('content')
@push('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip(); //Tooltip on icons top

            $('.popoverOption').each(function () {
                var $this = $(this);
                $this.popover({
                    trigger: 'hover',
                    placement: 'left',
                    container: $this,
                    html: true
                });
            });
        });
    </script>
@endpush

    <?php
    $data = Session::get('data');
    ?>
<h1>Create Contact</h1>
<hr>
    {!! Form::open([
            'route' => 'contacts.store',
            'class' => 'ui-form',
            'id' => 'contactCreateForm'
            ]) !!}
    @include('contacts.form', ['submitButtonText' => __('Create New Contact')])
    {!! Form::close() !!}


@stop
