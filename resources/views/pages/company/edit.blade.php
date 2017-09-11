@extends("layouts/default")

@section("head")
    <title>Invoice Plz</title>
    <style>
        .logo-display-container, .smlogo-display-container {
            display: inline-block;
        }

        .logo-display-container img, .smlogo-display-container img {
            max-height: 100px;
            max-width: 250px;
            margin-top: 15px;

            object-fit: cover;
            object-position: center right;
        }

        span.text-content {
            width: 300px;
            padding: 10px 0;
            margin-top: 15px;
            background: rgba(0,0,0,0.5);
            color: white;
            cursor: pointer;
            display: table;
            position: absolute;
            top: 0;
            opacity: 0;
            -webkit-transition: opacity 500ms;
            -moz-transition: opacity 500ms;
            -o-transition: opacity 500ms;
            transition: opacity 500ms;
        }

        span.text-content span {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }

        .logo-display-container:hover span.text-content, .smlogo-display-container:hover span.text-content {
            opacity: 1;
        }
    </style>
@stop

@section("content")
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h3>Company</h3>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m3 xl2">
                @include("partials/sidenav")
            </div>
            <div class="col s12 m9 xl10">
                <form id="edit-company" method="post" enctype="multipart/form-data">
                    <div class="card-panel">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="name" name="name" type="text" data-parsley-required="true" data-parsley-trigger="change" data-parsley-minlength="4" value="{{ $company->name }}">
                                <label for="name" class="label-validation">Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="slug" name="slug" type="text" data-parsley-required="true" data-parsley-trigger="change" value="{{ $company->slug }}">
                                <label for="slug" class="label-validation">Slug</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="crn" name="crn" type="text" data-parsley-required="true" data-parsley-trigger="change" data-parsley-minlength="6" value="{{ $company->crn }}">
                                <label for="crn" class="label-validation">Registration Number</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="logo-container input-field col s12">
                                <label for="logo-display" class="label-validation">Logo</label>
                                <div class="logo-display-container tooltipped" data-position="left" data-delay="50" data-tooltip="Recommended Size: 210 (W) x 110 (H) with White Background">
                                    <img id="logo-display" src="{{ $company->logo }}" height="100">
                                    <span class="text-content"><span id="logo-upload">Change?</span></span>
                                </div>
                                <input id="logo" name="logo" type="file" accept="image/*" style="display: none;" data-maxsize="10M">
                            </div>
                        </div>
                        <div class="row">
                            <div class="smlogo-container input-field col s12">
                                <label for="smlogo-display" class="label-validation">Small Logo</label>
                                <div class="smlogo-display-container tooltipped" data-position="left" data-delay="50" data-tooltip="Recommended Size: 80 (W) x 80 (H) with White Background">
                                    <img id="smlogo-display" src="{{ $company->smlogo }}" height="100">
                                    <span class="text-content"><span id="smlogo-upload">Change?</span></span>
                                </div>
                                <input id="smlogo" name="smlogo" type="file" accept="image/*" style="display: none;" data-maxsize="10M">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <button class="btn waves-effect waves-light col s2 offset-s10" type="submit" name="action">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section("scripts")
    <script type="text/javascript">
        "use strict";
        $(function() {
            $('#logo-upload').click(function(){
                $('#logo').click();
            });

            $('#smlogo-upload').click(function(){
                $('#smlogo').click();
            });

            $("#logo").on("change", function()
            {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function(){ // set image data as background of div
                        $("#logo-display").attr("src", this.result);
                    }
                }
            });

            $("#smlogo").on("change", function()
            {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function(){ // set image data as background of div
                        $("#smlogo-display").attr("src", this.result);
                    }
                }
            });

            $('#edit-company').parsley({
                successClass: 'valid',
                errorClass: 'invalid',
                errorsContainer: function (velem) {
                    var $errelem = velem.$element.siblings('label');
                    $errelem.attr('data-error', window.Parsley.getErrorMessage(velem.validationResult[0].assert));
                    return true;
                },
                errorsWrapper: '',
                errorTemplate: ''
            })
                .on('field:validated', function(velem) {

                })
                .on('field:success', function(velem) {

                })
                .on('field:error', function(velem) {
                })
                .on('form:submit', function(velem) {
                });
        });
    </script>
@stop