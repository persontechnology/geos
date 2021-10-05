<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Antenas') }}
        </h2>
        <form class="mb-5" action="{{ route('antenas-guardar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div>
                        <label for="formFileLg" class="form-label">Importar datos de antenas</label>
                        <div class="d-grid gap-2 border border-success">
                        <input class="form-control" name="antenas" id="formFileLg" type="file" required>
                        </div>
                      </div>
                      
                </div>
                <div class="col-md-3 col-sm-12">
                    <button type="submit" class="btn btn-success btn-block">Importar excel</button>
                    <a href="{{ route('vaciarAntenas') }}" class="btn btn-danger">Vaciar Registro</a>
                </div>
              </div>
          </form>
        
        
        
    </x-slot>

    <div class="py-2">
        <div class="max-w-12xl mx-auto sm:px-12 lg:px-12">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="table-responsive">
                    <table class="table table-bordered table-auto">
                        <thead>
                        <tr>
                            <th scope="col">CÓDIGO</th>
                            <th scope="col">RADIO</th>
                            <th scope="col">MCC</th>
                            <th scope="col">NET</th>
                            <th scope="col">ÁREA</th>
                            <th scope="col">CELL</th>
                            <th scope="col">LONGITUD</th>
                            <th scope="col">LATITUD</th>
                            <th scope="col">RANGE</th>
                            <th scope="col">POTENCIA(dBm)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($antenas as $a)
    

                        <tr>
                            <td>{{ $a->codi }}</td>
                            <td>{{ $a->radio }}</td>
                            <td>{{ $a->mcc }}</td>
                            <td>{{ $a->net }}</td>
                            <td>{{ $a->area }}</td>
                            <td>{{ $a->cell }}</td>
                            <td>{{ $a->lon }}</td>
                            <td>{{ $a->lat }}</td>
                            <td>{{ $a->range }}</td>
                            <td>{{ $a->potencia }}</td> 
                            
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $antenas->links() }}
                </div>
                
            </div>
        </div>
    </div>


</x-app-layout>
