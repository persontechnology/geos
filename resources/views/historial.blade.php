<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial Georeferencia GPS') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-12xl mx-auto sm:px-12 lg:px-12">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="table-responsive">
                    <table class="table table-bordered table-auto">
                        <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Movistar</th>
                            <th scope="col">Claro</th>
                            <th scope="col">Cnt</th>
                            <th scope="col">P.Movistar</th>
                            <th scope="col">P.Claro</th>
                            <th scope="col">P.Cnt</th>
                            <th scope="col">Tiempo</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Coordenadas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($geos as $geo)
    

                        <tr id="datos">
                            <td id="codDispositivo">{{ $geo->codDispositivo }}</td>
                            <td id="codMovistar">{{ $geo->codMovistar }}</td>
                            <td id="codClaro">{{ $geo->codClaro }}</td>
                            <td id="codCnt">{{ $geo->codCnt }}</td>
                            <td id="potenciaMovistar">{{ $geo->potenciaMovistar }}</td>
                            <td id="potenciaClaro">{{ $geo->potenciaClaro }}</td>
                            <td id="potemciaCnt">{{ $geo->potemciaCnt }}</td>
                            <td id="tiempoActualizacion">{{ $geo->tiempoActualizacion }}</td>
                            <td id="fecha">{{ $geo->created_at }}</td>
                            <td id="coor">{{ $geo->latitud }} {{ $geo->longitud }}</td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $geos->links() }}
                </div>
                
            </div>
        </div>
    </div>


</x-app-layout>
