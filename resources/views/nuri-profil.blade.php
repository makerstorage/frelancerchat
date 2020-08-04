@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row justify-content-center">
        <div class="col-sm-12">
				<a href="/serkan">Goto Serkan Profil</a>
				<h1>Nuri Profil</h1>
            {{--                Serkan - vue kullandigim icin template yaptim--}}
            <chat-start></chat-start>
            {{--                end Serkan --}}
        </div>
    </div>
</div>
@endsection