@extends('layouts.master')

@section('title')
    Create new Company
@endsection

@section('content')
    {!! Form::model($company, ['action' => 'UserController@store']) !!}
        <div id="tabs">
            <ul>
                <li><a href="#tabs-loginInfo">Login Info (required)</a></li>
                <li><a href="#tabs-anagraphics">Informazioni Anagrafiche</a></li>
                <li><a href="#tabs-contatti">Informazioni di Contatto</a></li>
                <li><a href="#tabs-security">Sicurezza Aggiuntiva</a></li>
                <li><a href="#tabs-more">Informazioni Aggiuntive</a></li>
            </ul>
            <div id="tabs-loginInfo">
                <div class="form-group">
                    {!! Form::label('username', 'Username *') !!}
                    {!! Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email di contatto *') !!}
                    {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'example@company.com', 'required' => ' required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Conferma Password') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div id="tabs-anagraphics">
                <div class="form-group">
                    {!! Form::label('first_name', 'Nome') !!}
                    {!! Form::text('first_name', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('middle_name', 'Secondo Nome') !!}
                    {!! Form::text('middle_name', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('last_name', 'Cognome') !!}
                    {!! Form::text('last_name', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('address', 'Indirizzo') !!}
                    {!! Form::text('address', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('country_id', 'Nazione') !!}
                    {!! Form::select('country_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleziona una Nazione']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('city_id', 'Provincia') !!}
                    {!! Form::select('city_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleziona una Provincia']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('zip_code', 'ZIP Code') !!}
                    {!! Form::text('zip_code', '', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div id="tabs-contatti">
                <div class="form-group">
                    {!! Form::label('cellphone', 'Telefono Cellulare') !!}
                    {!! Form::text('cellphone', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('telephone', 'Telefono Fisso') !!}
                    {!! Form::text('telephone', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fax', 'Fax') !!}
                    {!! Form::text('fax', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('piva', 'Partita Iva') !!}
                    {!! Form::text('piva', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('company_id', 'Società') !!}
                    {!! Form::select('company_id', $companies, null, ['class' => 'form-control', 'placeholder' => 'Seleziona una Società di Appartenenza']) !!}
                </div>
            </div>

            <div id="tabs-security">
                <div class="form-group">
                    {!! Form::label('question', 'Domanda di Sicurezza') !!}
                    {!! Form::text('question', '', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('answer', 'Risposta alla domanda di sicurezza') !!}
                    {!! Form::text('answer', '', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div id="tabs-more">
                <div class="form-group">
                    {!! Form::label('more_info', 'Informazioni Addizionali') !!}
                    {!! Form::textarea('more_info', '', ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-success pull-right" type="submit">Aggiungi la Società</button>
        </div>

    {!! Form::close() !!}
@endsection

@section('addedJavascript')
    <link rel="stylesheet" type="text/css" href="{{asset('jQueryui/jquery-ui.min.css')}}"/>
    <script type="text/javascript" src="{{asset('jQueryui/jquery-ui.min.js')}}"></script>

    <script type="text/javascript">
        var locationJson = {!! $locations !!};

        $.each(locationJson.country, function (index, value) {
            $("#country_id").append('<option value="' + value.id + '">' + value.name + '</option>');
        });

        $('#country_id').on('change', function () {
            for (var i = 0; i < locationJson.country.length; i++) {
                if (locationJson.country[i].id == $(this).val()) {
                    $('#city_id').html('');
                    $.each(locationJson.country[i].cities, function (index, value) {
                        $("#city_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            }
        });

        $(document).ready(function(){
            $( function() {
                $( "#tabs" ).tabs();
            } );
        });
    </script>
@endsection