<div class="p-6">

    <div class="flex items-center  px-4 text-right sm:px-6">
@foreach ($usuario as $user)
<h3 class="text-center">Detalles del Pedido del usuario -- {{$user->vch_Nombres}} {{$user->vch_A_Paterno}} </h3>
@endforeach
      
        
    </div>
    <br>

    {{-- The data table --}}

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    {{-- Tabla --}}
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre platillo
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Presentacion del platillo
                                </th>                         
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Cantidad
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Precio
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha del pedido
                                </th>                               
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            
                           

                            @if ($data->count())
                            @foreach ($data as $detalle)
                                <tr>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $detalle->Vch_Nombre_P_d }}</td>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $detalle->Vch_Presentacion_P_d }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $detalle->int_Cantidad_d }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $detalle->flt_Precio_d }}
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $detalle->date_Fecha_Pedido_d }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td><span class="text-xs text-black-500 italic">{{ 'No hay resultados' }}</span>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

