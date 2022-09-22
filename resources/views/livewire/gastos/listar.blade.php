<table class="table" style="font-size: 12px">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Valor</th>
            <th>Descripcion</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gastos as $g)
            <tr>
                <th>{{ $g->id }}</th>
                <td>{{ $g->nombre }}</td>
                <td>{{ $g->created_at }}</td>
                <td>{{ $g->valor }}</td>
                <td>{{ $g->descripcion }}</td>
                <td>
                    <a href="javascript:void(0)" wire:click="Edit({{ $g->id }})" class="btn btn-link mtmobile"
                        title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pen" viewBox="0 0 16 16">
                            <path
                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                        </svg>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- {{$gastos->links()}} --}}
