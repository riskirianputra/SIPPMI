<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Main styles for this application-->
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pace.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quill.coreui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
{{--    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />--}}
{{--    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />--}}
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-coreui.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/@coreui/icons@1.0.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('styles')

</head>

<body class="c-app">

@include("layouts.app.nav")
@include('layouts.app.sidebar')

{{--@include('layouts.app.sidebar')--}}

<div class="c-wrapper">

    @include('layouts.app.header')

    <div style="padding-top: 20px" class="container-fluid">
        @if(session('message'))
            <div class="row mb-2">
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                </div>
            </div>
        @endif
    </div>

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">

                    @if($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    @include('layouts.app.footer')

</div>
<!-- CoreUI and necessary plugins-->
<script src="{{ asset('js/pace.min.js') }}" ></script>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
<!--[if IE]><!-->
<script src="{{ asset('vendors/@coreui/icons/js/svgxuse.min.js') }}"></script>
<!--<![endif]-->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
{{--<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>--}}
{{--<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>--}}
{{--<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>--}}
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="{{ asset('js/quill.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@include('sweet::alert')

<script>
    $(document).ready(function () {
        window._token = $('meta[name="csrf-token"]').attr('content')
    });

    // $(function() {
        {{--let copyButtonTrans = '{{ trans('global.datatables.copy') }}'--}}
        {{--let csvButtonTrans = '{{ trans('global.datatables.csv') }}'--}}
        {{--let excelButtonTrans = '{{ trans('global.datatables.excel') }}'--}}
        {{--let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'--}}
        {{--let printButtonTrans = '{{ trans('global.datatables.print') }}'--}}
        {{--let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'--}}
        {{--let selectAllButtonTrans = '{{ trans('global.select_all') }}'--}}
        {{--let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'--}}

        // let languages = {
        //     'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
        //     'id': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
        // };

        {{--$.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })--}}
        {{--$.extend(true, $.fn.dataTable.defaults, {--}}
        {{--    language: {--}}
        {{--        url: languages['{{ app()->getLocale() }}']--}}
        {{--    },--}}
            // columnDefs: [{
            //     orderable: false,
            //     className: 'select-checkbox',
            //     targets: 0
            // }, {
            //     orderable: false,
            //     searchable: false,
            //     targets: -1
            // }],
            // select: {
            //     style:    'multi+shift',
            //     selector: 'td:first-child'
            // },
            // order: [],
            // scrollX: true,
            // pageLength: 100,
            // dom: 'lBfrtip<"actions">',
            // buttons: [
                // {
                //     extend: 'selectAll',
                //     className: 'btn-primary',
                //     text: selectAllButtonTrans,
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                // {
                //     extend: 'selectNone',
                //     className: 'btn-primary',
                //     text: selectNoneButtonTrans,
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                // {
                //     extend: 'copy',
                //     className: 'btn-default',
                //     text: copyButtonTrans,
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                // {
                //     extend: 'csv',
                //     className: 'btn-default',
                //     text: csvButtonTrans,
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                // {
                //     extend: 'excel',
                //     className: 'btn-default',
                //     text: excelButtonTrans,
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                // {
                //     extend: 'pdf',
                //     className: 'btn-default',
                //     text: pdfButtonTrans,
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                // {
                //     extend: 'print',
                //     className: 'btn-default',
                //     text: printButtonTrans,
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // },
                // {
                //     extend: 'colvis',
                //     className: 'btn-default',
                //     text: colvisButtonTrans,
                //     exportOptions: {
                //         columns: ':visible'
                //     }
                // }
            // ]
    //     });
    //
    //     $.fn.dataTable.ext.classes.sPageButton = '';
    // });

</script>
<script>
    $(document).ready(function () {
        $('.select2').select2({theme: 'coreui'})
    });
</script>
@yield('scripts')
</body>
