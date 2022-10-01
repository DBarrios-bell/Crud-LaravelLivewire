<div class="container-sm">
    <div class="row justify-content-center">
        <div class="card-header d-grid gap-2 d-md-flex justify-content-md-start">
            <h3>{{ __('Registrar Usuarios') }}
        </div>
        <div class="card-body">
            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
            @if (session('danger'))
                <h6 class="alert alert-danger">{{ session('danger') }}</h6>
            @endif
            <div class="row mb-2">
                <label for="cedula" class="col-md-4 col-form-label text-md-end">{{ __('Numero de cedula') }}</label>

                <div class="col-md-6">
                    <input type="number" wire:model.lazy="cedula"
                        class="form-control @error('cedula') is-invalid @enderror" name="cedula"
                        value="{{ old('cedula') }}" required autocomplete="cedula" autofocus>

                    @error('cedula')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-2">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

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
                <label for="apellido" class="col-md-4 col-form-label text-md-end">{{ __('Apellido') }}</label>

                <div class="col-md-6">
                    <input type="text" wire:model.lazy="apellido"
                        class="form-control @error('apellido') is-invalid @enderror" name="apellido"
                        value="{{ old('apellido') }}" required autocomplete="apellido" autofocus>

                    @error('apellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-2">
                <label for="perfil" class="col-md-4 col-form-label text-md-end">{{ __('perfil') }}</label>

                <div class="col-md-6">
                    <input type="text" wire:model.lazy="perfil"
                        class="form-control @error('perfil') is-invalid @enderror" name="perfil"
                        value="{{ old('perfil') }}" required autocomplete="perfil" autofocus>

                    @error('perfil')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="row mb-2">
                <label for="email"
                    class="col-md-4 col-form-label text-md-end">{{ __('Correo Electronico') }}</label>

                <div class="col-md-6">
                    <input id="" type="email" wire:model.lazy="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                        required="required" autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-2">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('password') }}</label>

                <div class="col-md-6">
                    <input type="password" wire:model.lazy="password"
                        class="form-control @error('password') is-invalid @enderror" name="password"
                        value="{{ old('password') }}" required autocomplete="password" autofocus>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-2">
                <label for="telefono"
                    class="col-md-4 col-form-label text-md-end">{{ __('Numero de telefono') }}</label>

                <div class="col-md-6">
                    <input type="number" wire:model.lazy="telefono"
                        class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                        value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>

                    @error('telefono')
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
                    <a href="{{ route('user') }}" class="btn btn-outline-danger" role="button">Cancelar</a>
                </div>
            </div>

        </div>

    </div>
</div>
