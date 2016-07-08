@extends('layouts/master')

@section('content')

    @javascript(compact('pusherKey', 'pusherCluster','pusherEncrypted'))

    <uptime-robot grid="a1:a2"></uptime-robot>

    <last-fm grid="b1:c1"></last-fm>

    <current-time grid="d1" dateformat="ddd DD/MM"></current-time>

    <packagist-statistics grid="b2"></packagist-statistics>

    <rain-forecast grid="c2"></rain-forecast>

    <internet-connection grid="d2"></internet-connection>

    <qwertee  grid="a3"></qwertee>

    <github-file file-name="rogier" grid="b3"></github-file>

    <github-file file-name="seb" grid="c3"></github-file>

    <github-file file-name="willem" grid="d3"></github-file>

@endsection