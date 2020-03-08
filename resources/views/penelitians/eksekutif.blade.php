@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Penelitian' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('manage_penelitian_user')
        {!! cui_toolbar_btn(route('penelitians.index'), 'icon-list', 'List Penelitian') !!}
    @endcan
@endsection

@section('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>

        .step-progressbar {
            list-style: none;
            counter-reset: step;
            display: flex;
            padding: 0;
        }
        .step-progressbar__item {
            display: flex;
            flex-direction: column;
            flex: 1;
            text-align: center;
            position: relative;
        }
        .step-progressbar__item:before {
            width: 3em;
            height: 3em;
            content: counter(step);
            counter-increment: step;
            align-self: center;
            background: #999;
            color: #fff;
            border-radius: 100%;
            line-height: 3em;
            margin-bottom: 0.5em;
        }
        .step-progressbar__item:after {
            height: 2px;
            width: calc(100% - 4em);
            content: '';
            background: #999;
            position: absolute;
            top: 1.5em;
            left: calc(50% + 2em);
        }
        .step-progressbar__item:last-child:after {
            content: none;
        }
        .step-progressbar__item--active:before {
            background: #000;
        }
        .step-progressbar__item--complete:before {
            content: '✔';
        }

    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <ul class="step-progressbar">
                <li class="step-progressbar__item step-progressbar__item--complete"><a href="{{ route('penelitians.edit', [$penelitian->id]) }}">Informasi Dasar</a></li>
                <li class="step-progressbar__item step-progressbar__item--active">Ringkasan<li>
                <li class="step-progressbar__item">Peneliti</li>
                <li class="step-progressbar__item">Submit</li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>Informasi Detail Usulan Penelitian</strong>
        </div>

        <div class="card-body">

            @include('penelitians._info')

            <div class="form-group row pb-4">
                <div class="col-sm-2">
                    <strong>Ringkasan Eksekutif</strong>
                </div>
                <div class="col-sm-10">
                    <div id="editor">
                        {!! $penelitian->ringkasan_eksekutif !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <form id='form_eksekutif' action="{{ route('penelitians.storeeksekutif', $penelitian->id) }}" method="POST"
                  style="display: none">
                @csrf
                <input type="text" name="ringkasan_eksekutif"/>
            </form>

            <a href="{{ route('penelitians.edit', $penelitian) }}" class="btn btn-danger">Kembali</a>
            <button type="button" class="btn btn-primary" onclick="submitform();">Selanjutnya</button>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="application/javascript">
        var quill;
        $(function () {
            quill = new Quill('#editor', {
                theme: 'snow'
            })
        });

        function submitform() {
            var form = document.getElementById('form_eksekutif');
            var editor = document.getElementById('editor');
            form.ringkasan_eksekutif.value = editor.getElementsByClassName('ql-editor')[0].innerHTML;
            form.submit();
        }
    </script>
@endsection

