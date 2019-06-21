@extends('layouts.main')

@section('content')
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">
                {{$category->name}}
            </h3>
        </div>
        <div class="box-body">
            <form method="post" id="dynamic-form">
                @csrf
                <fieldset>
                    <legend>
                        PREGUNTA
                    </legend>
                    <div class="form-group">
                    <textarea name="question[description]" class="form-control rich-control"></textarea>
                    </div>
                </fieldset>

                <fieldset id="answers-block">
                    <legend>
                        RESPUESTAS
                        <button class="btn btn-xs btn-primary" id="btn-add-answer" type="button">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </legend>
                </fieldset>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/plugins/ckeditor/ckeditor.js"></script>
    <script>
        $(function(){
            function addAnswer(){
                var $block = "<div class='form-group'>" +
                    "<input type='checkbox' value='1'>" +
                    "<label></label> <button type='button' class='btn btn-xs btn-danger remove-answer'><i class='fas fa-trash'></i></button>" +
                    "<textarea name='answer[][description]' class='form-control rich-control'>" +
                    "</textarea>" +
                    "</div>" ;

                var $content = $("#answers-block");
                $content.append($block);
                $(".remove-answer").on("click", function(e){
                    e.preventDefault();
                    $(this).closest(".form-group").remove();
                    rename();
                });
                rename();
            }

            function rename(){
                $("#answers-block .form-group").each(function(index){
                    var $item = $(this);
                    $item.find("label").html("RESPUESTA "+(index+1));
                    $item.find("input").prop('name', 'answers['+index+'][correct]');
                    $item.find("textarea").prop('name', 'answers['+index+'][description]');
                });
            }

            $("#btn-add-answer").on("click", function(e){
                e.preventDefault();
                addAnswer();
            });

            CKEDITOR.replaceAll('rich-control');

        });
    </script>
@endpush