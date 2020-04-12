@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Pengabdian' => route('admin.pengabdians.index'),
        'Edit' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('pengabdian_view')
        {!! cui_toolbar_btn(route('admin.pengabdians.index'), 'cil-list', 'List Usulan Pengabdian') !!}
    @endcan
@endsection

@section('content')
    <div class="col">

        {{ html()->modelForm($pengabdian, 'PUT', route('admin.pengabdians.update', [$pengabdian->id]))->acceptsFiles()->open() }}
        <div class="card">
            <div class="card-header font-weight-bold">
                {{ trans('global.edit') }} {{ trans('cruds.pengabdian.title_singular') }}
            </div>

            <div class="card-body">
                @include('pengabdians._form')
            </div>

            <div class="card-footer">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
        {{ html()->form()->close() }}
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
