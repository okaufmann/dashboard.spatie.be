@extends('layouts/master')

@section('content')

    @javascript(compact('pusherKey', 'pusherCluster','pusherEncrypted'))

    <google-calendar grid="a1:a2"></google-calendar>

    <last-fm grid="b1:c1"></last-fm>

    <current-time grid="d1" dateformat="ddd DD/MM"></current-time>

    <packagist-statistics grid="b2"></packagist-statistics>

    <rain-forecast grid="d3"></rain-forecast>

    <internet-connection grid="d2"></internet-connection>

    <qwertee  grid="a3"></qwertee>

    <rls-notifier grid="b3"></rls-notifier>

    <uptime-robot grid="c2:c3"></uptime-robot>


@endsection