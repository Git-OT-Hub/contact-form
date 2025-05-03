@extends('layouts.app')

@section('title', 'お問い合わせ確認画面')

@section('vite')
    @vite(['resources/css/individual/contacts/confirm.css'])
@endsection

@section('content')
<h1>確認画面</h1>
{{ print_r($contact) }}
<br>
{{ gettype($contact['gender']) }}
@endsection