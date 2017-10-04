@extends('layouts.master')

@section('title')
    Lista Utenti
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ URL::action('UserController@create') }}" class="btn btn-info">Nuovo Utente</a>
            <a href="{{ URL::action('UserController@bin') }}" class="btn btn-info">Recycle Bin</a>
        </div>
    </div>
    <table class="table table-inverse" id="usersTable">
        <thead>
        <tr>
            <th>
                #
            </th>
            <th>
                Username
            </th>
            <th>
                Email
            </th>
            <th>
                Nome
            </th>
            <th>
                Cognome
            </th>
            <th>
                Nazione
            </th>
            <th>
                Provincia
            </th>
            <th>
                Società
            </th>
            <th>
                Azioni
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    {{ $user->id }}
                </td>
                <td>
                    {{ $user->username }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ $user->userInfo->first_name }}
                </td>
                <td>
                    {{ $user->userInfo->last_name }}
                </td>
                <td>
                    {{ $user->country->name }}
                </td>
                <td>
                    {{ $user->city->name }}
                </td>
                <td>
                    {{ $companyName }}
                </td>
                <td>
                    {{ Form::open(array('route' => array('users.destroy', $user->id), 'method' => 'delete')) }}
                    <a href="{{ URL::action('UserController@edit', $user->id) }}"
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
                Username
            </th>
            <th>
                Email
            </th>
            <th>
                Nome
            </th>
            <th>
                Cognome
            </th>
            <th>
                Nazione
            </th>
            <th>
                Provincia
            </th>
            <th>
                Società
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
            $('#usersTable').DataTable({
                "order": [[0, "desc"]],
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
@endsection