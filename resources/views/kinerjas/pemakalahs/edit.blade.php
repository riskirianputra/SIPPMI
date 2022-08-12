@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Kinerja' => route('pemakalahs.index'),
        'Pemakalah' => route('pemakalahs.index'),
        'Edit' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('pemakalahs.index'), 'cil-list', 'List Makalah') !!}
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
                <li class="step-progressbar__item step-progressbar__item--active">
                    <a href="#">Makalah</a>
                </li>
                <li class="step-progressbar__item">
                    <a href="#">Penulis</a>
                </li>
                <li class="step-progressbar__item">Submit</li>
            </ul>
        </div>
    </div>

    <div class="card">

        {{ html()->modelForm($pemakalah, 'POST', route('pemakalahs.update', [$pemakalah->id]))->acceptsFiles()->open() }}

        <div class="card-header font-weight-bold">
            <i class="cil-plus"></i> Tambah Makalah
        </div>

        <div class="card-body">
            @include('kinerjas.pemakalahs._form')
        </div>

        <div class="card-footer">
            <button class="btn btn-primary" type="submit">
                Selanjutnya
            </button>
        </div>

        {{ html()->closeModelForm() }}
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var quill = new Quill('#editor', {
                theme: 'snow',   // Specify theme in configuration
                modules: {
                    toolbar: ['bold', 'italic', 'underline']
                }
            });

            var editor = document.getElementById('editor').getElementsByClassName('ql-editor')[0];
            var inputJudul = document.getElementById("judul");
            var text = "";

            quill.on('text-change', function () {
                text = editor.innerHTML;
                console.log(text);
                inputJudul.value = text;
            })
        });
    </script>
@endsection
