@extends('layouts.master')

@section('title')
    Lista Società
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ URL::action('CompanyController@create') }}" class="btn btn-info">Nuova Società</a>
            <a href="{{ URL::action('CompanyController@bin') }}" class="btn btn-info">Recycle Bin</a>
        </div>
    </div>
    <table class="table table-inverse" id="companiesTable">
        <thead>
        <tr>
            <th>
                #
            </th>
            <th>
                Nome Società
            </th>
            <th>
                Email
            </th>
            <th>
                Telefono
            </th>
            <th>
                Nazione
            </th>
            <th>
                Provincia
            </th>
            <th>
                Azioni
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($companies as $company)
            <tr>
                <td>
                    {{ $company->id }}
                </td>
                <td>
                    {{ $company->name }}
                </td>
                <td>
                    {{ $company->email }}
                </td>
                <td>
                    {{ $company->telephone }}
                </td>
                <td>
                    {{ $company->country->name }}
                </td>
                <td>
                    {{ $company->city->name }}
                </td>
                <td>
                    {{ Form::open(array('route' => array('companies.destroy', $company->id), 'method' => 'delete')) }}
                    <a href="{{ URL::action('CompanyController@edit', $company->id) }}"
                       class="btn btn-warning">Modifica</a>
                    <button type="submit" class="btn btn-danger">Cancella</button>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>
                #
            </th>
            <th>
                Nome Società
            </th>
            <th>
                Email
            </th>
            <th>
                Telefono
            </th>
            <th>
                Nazione
            </th>
            <th>
                Provincia
            </th>
            <th>
                Azioni
            </th>
        </tr>
        </tfoot>
    </table>
@endsection

@section('addedJavascript')
    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
    <script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#companiesTable').DataTable({
                "order": [[0, "desc"]],
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
@endsection