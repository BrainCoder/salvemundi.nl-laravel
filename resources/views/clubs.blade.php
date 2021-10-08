@extends('layouts.app')
@section('content')

<div class="overlap">
    <div class="row mb-4">
        @foreach ($clubs as $club)
            <div class="px-2 mb-3 col-12 col-md-6">
                <div class="card h-100" style="min-height: 15em;">
                    <div class="row g-0 h-100">
                        <div class="col-md-5 d-flex align-items-center">
                            {{-- <img src="..." class="img-fluid rounded-start" alt="..."> --}}
                            {!! '<img class="img-fluid rounded-start h-100 w-100" style="object-fit: cover;" src="storage/'.$club->imgPath.'" />' !!}
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h2 class="card-title">{{ $club->clubName}}</h2>
                                <p class="card-text">
                                    @if (session('id') != null)
                                    <div class="row">
                                        <div class="col-auto">
                                            <a href="{{ $club->whatsappLink }}"><button class="btn btn-primary mb-3"><i class="fab fa-whatsapp"></i> Join club</button></a> <br>
                                        </div>
                                        @if ($club->discordLink)
                                            <div class="col-auto">
                                                <a href="{{ $club->discordLink }}"><button class="btn btn-primary mb-3" href="{{ $club->discordLink }}"><i class="fab fa-discord"></i> Join Discord</button></a> <br>
                                            </div>
                                        @endif
                                        @if ($club->otherLink)
                                            <div class="col-auto">
                                                <a href="{{ $club->otherLink}}"><button class="btn btn-primary mb-3" i class="fab fa-discord"></i> Join </button></a>  <br>
                                            </div>
                                        @endif
                                    </div>
                                    @endif
                                    <small class="text-muted">
                                        @if ($club->founderName != null)
                                            <b>Naam oprichter:</b> {{ $club->founderName }} <br>
                                        @endif
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
