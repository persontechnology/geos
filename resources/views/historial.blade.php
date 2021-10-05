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
                            <th scope="col">Dispositivo</th>
                            <th scope="col">LAC:MOVISTAR</th>
                            <th scope="col">CID:MOVISTAR</th>
                            <th scope="col">LAC:CLARO</th>
                            <th scope="col">CID:CLARO</th>
                            <th scope="col">LA:CNT</th>
                            <th scope="col">CID:CNT</th>
                            <th scope="col">RSSI:MOVISTAR</th>
                            <th scope="col">RSSI:CLARO</th>
                            <th scope="col">RSSI:CNT</th>
                            <th scope="col">TIEMPO SUBIDA</th>
                            <th scope="col">LATITUD</th>
                            <th scope="col">LONGITUD</th>
                            <th scope="col">FECHA</th>
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
                            <td>{{ $geo->created_at }}</td>
                            
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
