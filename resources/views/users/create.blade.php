@extends('layouts.master')

@section('title')
    Create new Company
@endsection

@section('content')
    {!! Form::model($company, ['action' => 'CompanyController@store']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Nome *') !!}
            {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nome della Società', 'required' => 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email di contatto') !!}
            {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'example@company.com']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('telephone', 'Telefono di Contatto') !!}
            {!! Form::text('telephone', '', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('fax', 'Fax di Contatto') !!}
            {!! Form::text('fax', '', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('url', 'URL Sito Web') !!}
            {!! Form::text('url', '', ['class' => 'form-control', 'placeholder' => 'http://www.company.com']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('address', 'Indirizzo') !!}
            {!! Form::text('address', '', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('country_id', 'Nazione *') !!}
            {!! Form::select('country_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleziona una Nazione']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('city_id', 'Provincia *') !!}
            {!! Form::select('city_id', [], null, ['class' => 'form-control', 'placeholder' => 'Seleziona una Provincia']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('zip_code', 'ZIP Code') !!}
            {!! Form::text('zip_code', '', ['class' => 'form-control']) !!}
        </div>

        <button class="btn btn-success" type="submit">Aggiungi la Società</button>
    {!! Form::close() !!}
@endsection

@section('addedJavascript')
    <script type="text/javascript">
        var locationJson = {!! $locations !!};

        $.each(locationJson.country, function (index, value) {
            $("#country_id").append('<option value="'+value.id+'">'+value.name+'</option>');
        });

        $('#country_id').on('change', function(){
            for(var i = 0; i < locationJson.country.length; i++)
            {
                if(locationJson.country[i].id == $(this).val())
                {
                    $('#city_id').html('');
                    $.each(locationJson.country[i].cities, function (index, value) {
                        $("#city_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }
            }
        });
    </script>
@endsection