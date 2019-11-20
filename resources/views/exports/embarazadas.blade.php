<table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Carrera</th>
            <th>Semanas de Embarazo</th>
            <th>Control</th>
            <th>Comentarios</th>
            <th>Fecha Probable de Parto</th>
            <th>Fecha de Ingreso</th>            
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>