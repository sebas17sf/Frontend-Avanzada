<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificacion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

     @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    <div class="container">
        <!-- Header -->
        <header class="sidebar">
            <div class="logo-container">
                <hr>
                <img src="https://srvcas.espe.edu.ec/authenticationendpoint/images/Logo-MiESPE.png" alt="Logo ESPE"
                    class="logo-image">
            </div>
            <hr>
            <div class="sidebar-links">

                <a href="{{ route('admin.index') }}" class="nav-link active">
                    <i class="material-icons">assignment</i> Aceptacion
                </a>

                <a href="{{ route('admin.index2') }}" class="nav-link">
                    <i class=" material-icons">description</i> Control
                </a>

                <a href="{{ route('admin.index3') }}" class="nav-link">
                    <i class="material-icons">work</i> Estudiantes-Culminados
                </a>

                <a href="{{ route('login.index') }}" class="logout-btn">
                    <i class="material-icons">exit_to_app</i> Cerrar Sesión
                </a>
            </div>
        </header>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                </nav>
                <div class="container-fluid">
                    <h4 class="h3 mb-2 text-gray-800 text-center"><b>Estudiantes Vinculacion con la Sociedad-
                            Verificacion</b></h4>
                    <hr>
                    <div class="form-group">
                        <input id="searchInput" class="form-control" placeholder="Buscar...">
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Lista de Estudiantes</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre Completo</th>
                                            <th scope="col">Cédula</th>
                                            <th scope="col">Correo Electrónico</th>
                                            <th scope="col">Ciudad</th>
                                            <th scope="col">Cohorte</th>
                                            <th scope="col">Periodo</th>
                                            <th scope="col">Carrera</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $usuario)
                                            <tr>
                                                <td>{{ $usuario['nombreCompleto'] }}</td>
                                                <td>{{ $usuario['cedula'] }}</td>
                                                <td>{{ $usuario['correoElectronico'] }}</td>
                                                <td>{{ $usuario['ciudad'] }}</td>
                                                <td>{{ $usuario['cohorte'] }}</td>
                                                <td>{{ $usuario['periodo'] }}</td>
                                                <td>{{ $usuario['carrera'] }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Acciones">
                                                        <form id="eliminarForm"
                                                            action="{{ route('admin.eliminar', ['correoElectronico' => $usuario['correoElectronico']]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="btn btn-danger btn-sm mr-1"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Rechazar" onclick="confirmarEliminar()">
                                                                <i class="fas fa-times"></i><b> Rechazar</b>
                                                            </button>
                                                        </form>
                                                        <form id="aceptarForm"
                                                            action="{{ route('admin.aceptar', ['correoElectronico' => $usuario['correoElectronico']]) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="button" class="btn btn-success btn-sm ml-1"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Aceptar" onclick="confirmarAceptar()">
                                                                <i class="fas fa-check"></i> <b>Aceptar</b>
                                                            </button>
                                                        </form>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-muted">
                                Total de datos: {{ count($usuarios) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            searchTerm = this.value.toLowerCase();

            var rows = document.querySelectorAll('table tbody tr');
            rows.forEach(function(row) {
                var fullName = row.cells[0].textContent.toLowerCase();
                var cedula = row.cells[1].textContent.toLowerCase();
                var email = row.cells[2].textContent.toLowerCase();
                var city = row.cells[3].textContent.toLowerCase();
                var cohort = row.cells[4].textContent.toLowerCase();
                var period = row.cells[5].textContent.toLowerCase();
                var career = row.cells[6].textContent.toLowerCase();

                if (fullName.includes(searchTerm) || cedula.includes(searchTerm) || email.includes(
                        searchTerm) || city.includes(searchTerm) || cohort.includes(searchTerm) || period
                    .includes(searchTerm) || career.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        function confirmarEliminar() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, Rechazar'
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    document.getElementById('eliminarForm').submit();
                }
            });
        }

        function confirmarAceptar() {
            Swal.fire({
              title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, Acepar'
            }).then((willAccept) => {
                if (willAccept.isConfirmed) {
                    document.getElementById('aceptarForm').submit();
                }
            });
        }
    </script>


    <footer class="footer">

        <span>© 202 Universidad de las Fuerzas Armadas ESPE - Todos los derechos reservados</span>

    </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
