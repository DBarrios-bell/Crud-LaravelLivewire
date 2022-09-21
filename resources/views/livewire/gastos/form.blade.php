<div class="container-sm">
    <div class="row justify-content-center">
        <div class="card-header d-grid gap-2 d-md-flex justify-content-md-start">
            <h3>{{ __('Detalle del Gasto') }}
        </div>
        <div class="card-body">
            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
            @if (session('danger'))
                <h6 class="alert alert-danger">{{ session('danger') }}</h6>
            @endif
            <div class="row mb-2">
                <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre del Gasto') }}</label>

                <div class="col-md-6">
                    <input type="text" wire:model.lazy="nombre"
                        class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                        value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-2">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Valor') }}</label>

                <div class="col-md-6">
                    <input type="text" wire:model.lazy="valor"
                        class="form-control @error('valor') is-invalid @enderror" name="valor"
                        value="{{ old('valor') }}" required autocomplete="valor" autofocus>
                    @error('valor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-2">
                <label for="descripcion" class="col-md-4 col-form-label text-md-end">{{ __('Descripcion') }}</label>

                <div class="col-md-6">
                    <input type="text" wire:model.lazy="descripcion"
                        class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"
                        value="{{ old('descripcion') }}" required autocomplete="descripcion" autofocus>

                    @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-6 offset-md-4">
                    @if ($selected_id < 1)
                        <button type="button" wire:click.prevent="store()" class="btn btn-outline-success">Guardar</button>
                    @else
                        <button type="button" wire:click.prevent="Update()" class="btn btn-outline-success">Actualizar</button>
                    @endif
                    <a href="{{ route('gastos') }}" class="btn btn-outline-danger" role="button">Cancelar</a>
                </div>
            </div>

        </div>

    </div>
</div>
