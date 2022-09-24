<div class="container">
    <div class="widget-heading">
        <h4 class="card-title text-center">
            <b>Reporte de Gastos</b>
        </h4>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-md-2">
                <div class="form-group">
                    <label>Seleccionar Usuario</label>
                    <select wire:model="userid" class="form-control">
                        <option value="0">Todos</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}">{{ $u->nombre . ' ' . $u->apellido }}</option>
                        @endforeach
                    </select>
                    @error('userid')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-10 col-md-2">
                <div class="form-group">
                    <label>Fecha Inicial</label>
                    <input type="date" wire:model.lazy="fromDate" class="form-control">
                    @error('fromDate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-10 col-md-2">
                <div class="form-group">
                    <label>Fecha Final</label>
                    <input type="date" wire:model.lazy="toDate" class="form-control">
                    @error('toDate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-10 col-md-2">
                <div class="form-group">
                    <label>Valor Minimo</label>
                    <input type="number" wire:model.lazy="Vmin" class="form-control">
                    @error('Vmin')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-10 col-md-2">
                <div class="form-group">
                    <label>Valor Maximo</label>
                    <input type="number" wire:model.lazy="Vmax" class="form-control">
                    @error('Vmax')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-10 col-md-2 align-self-center d-flex justify-content-around">
                @if ($userid >= 0 && $fromDate != null && $toDate != null)
                    <button wire:click.prevent="Consultar" type="button" class="btn btn-dark">Consultar</button>
                @endif
            </div>
            <div class="col-sm-10 col-md-2">
            <a class="btn btn-dark btn-block {{ count($expenses) < 1 ? 'disabled' : '' }}"
                href="{{ url('report/excel' . '/' . $userid . '/' . $fromDate . '/' . $toDate) }}"
                target="_blank">Exportar a Excel</a>
            </div>
            <div class="col-sm-10 col-md-2">
            <a class="btn btn-dark btn-block {{ count($expenses) < 1 ? 'disabled' : '' }}"
                                        href="{{ url('report/pdf' . '/' . $userid . '/' . $fromDate . '/' . $toDate) }}"
                                        target="_blank">Generar PDF</a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped mt-1">
        <thead class="text-black">
            <tr>
                <th class="table-th text-center">ITEM</th>
                <th class="table-th text-center">ID</th>
                <th class="table-th text-center">USUARIO</th>
                <th class="table-th text-center">NOMBRE</th>
                <th class="table-th text-center">VALOR</th>
                <th class="table-th text-center">FECHA</th>
                <th class="table-th text-center">DESCRIPCION</th>
            </tr>
        </thead>
        <tbody>
            @if (count($expenses) < 1)
                <tr>
                    <td colspan="7">
                        <h6 class="text-center">No Hay Gastos</h6>
                    </td>
                </tr>
            @else
                @foreach ($expenses as $row)
                    <tr>
                        <td class="text-center">
                            <h6>{{ $row->id }}</h6>
                        </td>
                        <td class="text-center">
                            <h6>{{ $row->id }}</h6>
                        </td>
                        <td class="text-center">
                            <h6>{{ $row->nombreuser}} {{$row->apellidouser}}</h6>
                        </td>
                        <td class="text-center">
                            <h6>{{ $row->nombre }}</h6>
                        </td>
                        <td class="text-center">
                            <h6>{{ $row->valor }}</h6>
                        </td>
                        <td class="text-center">
                            <h6>{{ $row->created_at }}</h6>
                        </td>
                        <td class="text-center">
                            <h6>{{ $row->descripcion }}</h6>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
