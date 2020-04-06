@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Skema' => route('admin.ref-skemas.index'),
        'Peertanyaan' => route('admin.ref-skemas.show', [$refSkema->id]),
        'Edit' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('ref_skema_manage')
        {!! cui_toolbar_btn(route('admin.ref-skemas.index'), 'cil-list', trans('global.list').' '.trans('cruds.refSkema.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.ref-skemas.show', [$refSkema->id]), 'cil-zoom', trans('global.show').' '.trans('cruds.refSkema.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.ref-skemas.questions.create', [$refSkema->id]), 'cil-plus', 'Tambah Pertanyaan' ) !!}
    @endcan
@endsection

@section('content')

    <div class="card">

        {{ html()->modelForm($question, 'PUT', route('admin.ref-skemas.questions.update', [$refSkema->id, $question->id]))->open() }}

        <div class="card-header">
            <strong><i class="cil-description"></i> Tambah Pertanyaan</strong>
        </div>

        <div class="card-body">

            @include('admins.ref_skemas.questions._form')

        </div>

        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Edit">
        </div>

        {{  html()->closeModelForm() }}

    </div>

@endsection


@section('scripts')
    <script>
        $(document).ready(function () {
            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                // ['blockquote', 'code-block'],

                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                // [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                // [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

                ['clean']                                         // remove formatting button
            ];

            var quill = new Quill('#editor', {
                theme: 'snow',   // Specify theme in configuration
                modules: {
                    toolbar: toolbarOptions
                }
            });

            var editor = document.getElementById('editor').getElementsByClassName('ql-editor')[0];
            var inputPertanyaan = document.getElementById("pertanyaan");
            var text = "";

            quill.on('text-change', function () {
                text = editor.innerHTML;
                console.log(text);
                inputPertanyaan.value = text;
            })
        });
    </script>
@endsection

