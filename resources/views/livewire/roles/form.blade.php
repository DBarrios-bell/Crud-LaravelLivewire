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
                <label for="roleName" class="col-md-4 col-form-label text-md-end">{{ __('Datos del Rol') }}</label>

                <div class="col-md-6">
                    <input type="text" wire:model.lazy="roleName"
                        class="form-control @error('roleName') is-invalid @enderror" name="roleName"
                        value="{{ old('roleName') }}" required autocomplete="roleName" autofocus>

                    @error('roleName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-6 offset-md-4">
                    @if ($selected_id < 1)
                        <button type="button" wire:click.prevent="CreateRole()" class="btn btn-outline-success">Guardar</button>
                    @else
                        <button type="button" wire:click.prevent="UpdateRole()" class="btn btn-outline-success">Actualizar</button>
                    @endif
                    <a href="{{ route('roles') }}" class="btn btn-outline-danger" role="button">Cancelar</a>
                </div>
            </div>

        </div>

    </div>
</div>
