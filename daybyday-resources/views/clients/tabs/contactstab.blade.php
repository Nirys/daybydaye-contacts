<table class="table table-hover" id="contacts-table">
    <h3>{{ __('Contacts') }}</h3>
    <thead>
    <th>{{ __('Name') }}</th>
    <th>{{ __('Email') }}</th>
    <th>{{ __('Phone') }}</th>
    <th><a href="{{route('contact.client.create', $client->external_id)}}" class="btn btn-md btn-brand float-right">@lang('New contact')</a></th>
    </tr>
    </thead>
</table>

@push('scripts')
    <script>
        $(function () {
            var table = $('#contacts-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: '{!! route('clients.contactDataTable',$client->external_id) !!}',
                drawCallback: function(){
                    var length_select = $(".dataTables_length");
                    var select = $(".dataTables_length").find("select");
                    select.addClass("tablet__select");
                },
                language: {
                    url: '{{ asset('lang/' . (in_array(\Lang::locale(), ['dk', 'en']) ? \Lang::locale() : 'en') . '/datatable.json') }}'
                },
                columns: [
                    {data: 'namelink', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'primary_number', name: 'primary_number'},
                    {defaultContent: ''}
                ]
            });

            $('#status-project').change(function() {
                selected = $("#status-project option:selected").val();
                if(selected == "all") {
                    table.columns(4).search( '' ).draw();
                } else {
                    table.columns(4).search( selected ? '^'+selected+'$' : '', true, false ).draw();
                }
            });

        });
    </script>
@endpush