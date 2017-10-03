@extends('layouts.master')

@section('title')
    Create new User
@endsection

@section('content')
{!! Form::model($user, ['action' => 'UserController@store']) !!}
    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'example@example.com']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('username', 'Username') !!}
        {!! Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'MyAwesomeUsername']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password_confirm', 'Confirm Password') !!}
        {!! Form::password('password_confirm', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('question', 'Security Question') !!}
        {!! Form::text('question', '', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('answer', 'Answer to th e Security Question') !!}
        {!! Form::text('answer', '', ['class' => 'form-control']) !!}
    </div>

    <button class="btn btn-success" type="submit">Add the User!</button>
{!! Form::close() !!}
@endsection