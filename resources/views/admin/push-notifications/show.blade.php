@extends('admin.layouts.app')
@section('title', 'Notificações via push')
@section('page_name', 'Notificações via push')

@section('content')
    <div class="card shadow mb-3">
        <div class="card-body">
            <h5 class="card-title">ENVIAR NOTIFICAÇÃO</h5>
            <h6 class="card-subtitle mb-2 text-muted">
                Enviar notificações push para aplicativos móveis de Narjes
            </h6>
            <img src="{{ asset('images/push_notification_example.png') }}" alt="example"
                class="mb-3 img-fluid rounded-3" />

            <form action="{{ route('admin.push-notifications.publish') }}" method="POST" id="push-notifications-form">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Título*</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                        value="{{ old('title') }}" maxlength="65" required>
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="description" class="form-label">Descrição*</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" maxlength="240" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="btn btn-primary text-uppercase px-4" id="btn-send" @env('local') disabled @endenv>
                    ENVIAR NOTIFICAÇÃO
                </button>

            </form>
        </div>
    </div>

@endsection
@push('script')
    <script>
        var sendBtn = document.querySelector('#btn-send');
        var form = document.querySelector('#push-notifications-form');
        form.addEventListener('submit', function() {
            sendBtn.disabled = true;
        });
    </script>
@endpush
