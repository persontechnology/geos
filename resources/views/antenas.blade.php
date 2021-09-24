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
                        <label for="formFileLg" class="form-label">Exportar datos de antenas</label>
                        <input class="form-control form-control-lg" name="antenas" id="formFileLg" type="file" required>
                      </div>
                </div>
                <div class="col-md-3 col-sm-12 d-grid gap-3">
                    <button type="submit" class="btn btn-success btn-block">Exportar excel</button>
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
                            <th scope="col">codi</th>
                            <th scope="col">radio</th>
                            <th scope="col">mcc</th>
                            <th scope="col">net</th>
                            <th scope="col">area</th>
                            <th scope="col">cell</th>
                            <th scope="col">lon</th>
                            <th scope="col">lat</th>
                            <th scope="col">range</th>
                            <th scope="col">potencia</th>
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
