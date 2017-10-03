@extends('layouts.master')

@section('title')
    Cestino - Lista Società
@endsection

@section('content')
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
                    <a href="{{ URL::action('CompanyController@restore', $company->id) }}">Ripristina</a>
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