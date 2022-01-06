@extends("layouts.default", ['page_title' => 'Notification | Edit'])

@section("head")
    <link href="{{ asset(mix('/assets/css/intlTelInput.css')) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset(mix('/assets/css/selectize.css')) }}" rel="stylesheet" type="text/css">
    <style>
    </style>
@stop

@section("content")
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h3>Notification</h3>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m3 xl2">
                @include("partials/sidenav-company")
            </div>
            <div class="col s12 m9 xl10">
                <form id="edit-company-settings" method="post" enctype="multipart/form-data">
                    <div class="card-panel">
                        <h5>Notification email</h5>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="notifRecipientAddress" name="notifRecipientAddress" type="email" data-parsley-trigger="change" data-parsley-minlength="2" value="{{ $notifConfigs['notifRecipientAddress'] ?? '' }}" placeholder="Notification recipient email" @if(!$company) disabled @endif>
                                <label for="notifRecipientAddress" class="label-validation">Send Notification To</label>
                                <span class="helper-text"></span>
                            </div>
                        </div>
                        <h5>Notify days before...</h5>
                        <p>Send a notification days before invoice date</p>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="weeklyInvoice" name="weeklyInvoice" type="number" data-parsley-trigger="change" data-parsley-minlength="2" value="{{ $notifConfigs['weeklyInvoice'] ?? '7' }}" placeholder="Weekly invoice" @if(!$company) disabled @endif>
                                <label for="weeklyInvoice" class="label-validation">Weekly Invoice</label>
                                <span class="helper-text"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="monthlyInvoice" name="monthlyInvoice" type="number" data-parsley-trigger="change" data-parsley-minlength="2" value="{{ $notifConfigs['monthlyInvoice'] ?? '7' }}" placeholder="Monthly invoice" @if(!$company) disabled @endif>
                                <label for="monthlyInvoice" class="label-validation">Monthly Invoice</label>
                                <span class="helper-text"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="yearlyInvoice" name="yearlyInvoice" type="number" data-parsley-trigger="change" data-parsley-minlength="2" value="{{ $notifConfigs['yearlyInvoice'] ?? '30' }}" placeholder="Yearly invoice" @if(!$company) disabled @endif>
                                <label for="yearlyInvoice" class="label-validation">Yearly Invoice</label>
                                <span class="helper-text"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <button class="btn waves-effect waves-light col s12 m3 offset-m9" type="submit" name="action" @if(!$company) disabled @endif>Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
