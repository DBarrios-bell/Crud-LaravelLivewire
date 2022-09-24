<div class="container-sm">
    <div class="row justify-content-center">
        <div class="card-header d-grid gap-2 d-md-flex justify-content-md-start">
            <h3>{{ __('Crear Permisos') }}
        </div>
        <div class="card-body">
            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
            @if (session('danger'))
                <h6 class="alert alert-danger">{{ session('danger') }}</h6>
            @endif
            <div class="row mb-2">
                <label for="permisoName" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                <div class="col-md-6">
                    <input type="text" wire:model.lazy="permisoName"
                        class="form-control @error('permisoName') is-invalid @enderror" name="permisoName"
                        value="{{ old('permisoName') }}" required autocomplete="permisoName" autofocus>

                    @error('permisoName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-6 offset-md-4">
                    @if ($selected_id < 1)
                        <button type="button" wire:click.prevent="CreatePermiso()" class="btn btn-outline-success">Guardar</button>
                    @else
                        <button type="button" wire:click.prevent="UpdatePermiso()" class="btn btn-outline-success">Actualizar</button>
                    @endif
                    <a href="{{ route('permisos') }}" class="btn btn-outline-danger" role="button">Cancelar</a>
                </div>
            </div>

        </div>

    </div>
</div>
