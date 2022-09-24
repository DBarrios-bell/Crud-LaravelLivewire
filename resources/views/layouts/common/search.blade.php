<form class="row g-3">
    <div class="col-auto">
        <h6>Fecha Desde</h6>
        <div class="form-group">
            <input type="text" wire:model="dateFrom" class="form-control flatpickr" placeholder="Click para elegir">
        </div>
    </div>
    <div class="col-auto">
        <h6>Fecha Hasta</h6>
        <div class="form-group">
            <input type="text" wire:model="dateTo" class="form-control flatpickr" placeholder="Click para elegir">
        </div>
    </div>
    <div class="col-auto">
        <h6>Elegir Usuario</h6>
        <div class="form-group">
            <select wire:model="" class="form-control flatpickr">
                <option value="0">Elegir</option>
                {{-- @foreach ($users as $user) --}}
                <option value="{{ Auth::user()->id }}">{{ Auth::user()->nombre . ' ' . Auth::user()->apellido }}</option>
                {{-- @endforeach --}}
            </select>
        </div>
    </div>
    <div class="col-auto">
        <label for="" hidden><br></label>
        {{-- <div class="form-group"> --}}
            <button wire:click="$refresh" class="btn btn-dark btn-block">Consultar</button>
        {{-- </div> --}}
    </div>
</form>
@include('layouts.common.scripts')
