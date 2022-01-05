@extends("layouts.default", ['page_title' => 'Client | Import'])

@section("head")
    <link href="{{ asset(mix('/assets/css/intlTelInput.css')) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset(mix('/assets/css/selectize.css')) }}" rel="stylesheet" type="text/css">
    <style>
    </style>
@stop

@section("content")
    <div class="container">
        <div class="row">
            <div class="col s6">
                <h3>Import Clients</h3>
            </div>
        </div>
        <div id="client-container" class="">
                <div class="row">
                    <div class="col s12">
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-panel">
                                <p>Allowed file type: CSV<br />You can <a class="blue-text text-darken-2" href="{{ url('/sampleImport.csv') }}">download</a> the sample file and fill it with your data.</p>
                                <div class="row">
                                    <div class="file-field input-field">
                                          <div class="btn">
                                                <span>File</span>
                                                <input type="file" name="clientImport" accept="text/csv" data-maxsize="10M" />
                                          </div>
                                          <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                          </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    {{ csrf_field() }}
                                    <button class="btn btn-link waves-effect waves-light col s12 m3 offset-m9" type="submit" name="action">Import</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@stop
