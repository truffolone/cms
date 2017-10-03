@extends('layouts.master')

@section('title')
    {{ $company->name }} - Modifica Società
@endsection

@section('content')
    {!! Form::open(['method' => 'UPDATE', 'route' => ['companies.update', $company->id]]) !!}
    {{ method_field('PUT') }}
    <div class="form-group">
        {!! Form::label('name', 'Nome *') !!}
        {!! Form::text('name', $company->name, ['class' => 'form-control', 'placeholder' => 'Nome della Società', 'required' => 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email di contatto') !!}
        {!! Form::text('email', $company->email, ['class' => 'form-control', 'placeholder' => 'example@company.com']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('telephone', 'Telefono di Contatto') !!}
        {!! Form::text('telephone', $company->telephone, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('fax', 'Fax di Contatto') !!}
        {!! Form::text('fax', $company->fax, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('url', 'URL Sito Web') !!}
        {!! Form::text('url', $company->url, ['class' => 'form-control', 'placeholder' => 'http://www.company.com']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('address', 'Indirizzo') !!}
        {!! Form::text('address', $company->address, ['class' => 'form-control']) !!}
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
        {!! Form::text('zip_code', $company->zip_code, ['class' => 'form-control']) !!}
    </div>

    <button class="btn btn-success" type="submit">Salva la Società</button>
    {!! Form::close() !!}
@endsection

@section('addedJavascript')
    <script type="text/javascript">
        var locationJson = {!! $locations !!};
        var preselectedCountryId = {{ $company->country_id }};
        var preselectedCityId = {{ $company->city_id }};

        $.each(locationJson.country, function (index, value) {
            if(value.id == preselectedCountryId)
            {
                $("#country_id").append('<option value="'+value.id+'" selected="selected">'+value.name+'</option>');
                preselectedCountryId = 0;
            }
            else
            {
                $("#country_id").append('<option value="'+value.id+'">'+value.name+'</option>');
            }
        });

        $('#country_id').on('change', function(){
            setupCity($(this).val());
        });

        setupCity(preselectedCountryId);

        function setupCity(countryId) {
            for(var i = 0; i < locationJson.country.length; i++)
            {
                if(locationJson.country[i].id == countryId)
                {
                    $('#city_id').html('');
                    $.each(locationJson.country[i].cities, function (index, value) {
                        if(value.id == preselectedCityId)
                        {
                            $("#city_id").append('<option value="'+value.id+'" selected="selected">'+value.name+'</option>');
                            preselectedCityId = 0;
                        }
                        else
                        {
                            $("#city_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                        }
                    });
                }
            }
        }
    </script>
@endsection