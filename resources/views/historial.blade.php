<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('vaciar') }}" class="text-red-600	text-right float-right	">Vaciar Registro</a>
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
                            <th scope="col">codDispositivo</th>
                            <th scope="col">codMovi</th>
                            <th scope="col">celdaMovi</th>
                            <th scope="col">codClaro</th>
                            <th scope="col">celdaClaro</th>
                            <th scope="col">codCnt</th>
                            <th scope="col">celdaCnt</th>
                            <th scope="col">potenciaMovistar</th>
                            <th scope="col">potenciaClaro</th>
                            <th scope="col">potenciaCnt</th>
                            <th scope="col">tiempoActualizacion</th>
                            <th scope="col">lat</th>
                            <th scope="col">long</th>
                            <th scope="col">Fecha</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($geos as $geo)
    

                        <tr id="datos">
                            <td>{{ $geo->codDispositivo }}</td>
                            <td>{{ $geo->codMovi }}</td>
                            <td>{{ $geo->celdaMovi }}</td>
                            <td>{{ $geo->codClaro }}</td>
                            <td>{{ $geo->celdaClaro }}</td>
                            <td>{{ $geo->codCnt }}</td>
                            <td>{{ $geo->celdaCnt }}</td>
                            <td>{{ $geo->potenciaMovistar }}</td>
                            <td>{{ $geo->potenciaClaro }}</td>
                            <td>{{ $geo->potenciaCnt }}</td>
                            <td>{{ $geo->tiempoActualizacion }}</td>
                            <td>{{ $geo->auxlt }}</td>
                            <td>{{ $geo->auxln }}</td>
                            <td>{{ $geo->created_at->diffForHumans() }}</td>
                            
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
