@extends('layouts.app')

@section('content')
    <div class="row pt-4">
        @foreach ($blogs as $b)
            <div class="col-xl-4 py-2">
                <div class="card">
                    <img src="storage/{{ $b->cover }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        @foreach ($b->tags as $t)
                            <a href="#" class="badge bg-warning text-dark text-decoration-none">{{ $t->name }}</a>
                        @endforeach
                        <p class="card-text pt-4 fw-bold">{{ $b->title }}</p>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="pe-4" style="font-size: 10px;">
                                    <i class="fa-regular fa-calendar-check pe-2"></i>{{ $thisController->dateOnly($b->created_at) }}
                                </span>
                                <span style="font-size: 10px;">
                                    <i class="fa-regular fa-clock"></i> {{ $thisController->timeOnly($b->updated_at) }}
                                </span>
                            </div>
                            <div>
                                <a href="/content/{{ $b->id }}" class="text-decoration-none text-primary">อ่านต่อ <i class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        </div>
                                            
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
