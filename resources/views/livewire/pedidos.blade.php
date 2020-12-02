<div class="p-6">
    <h4 class="text-center text-dark-400">Listado de pedidos</h4>
    <hr>
    <div class="lead">
        <div class="card-deck">
            <!-- Tarjeta de pedido   1/2 -->

            @foreach ($data as $pedidos)
            <div class="col-md-4"> 
                <div class="card">
                    <h5 class="card-title text-left"><span class="badge badge-info">ID Pedido: {{$pedidos->id}} </span> </h5>
                    <div class="card-body">
                       
                        <h5 class="card-title text-center"><span class="badge badge-dark">Pedido n'#' {{$pedidos->vch_Num_Venta}} </span> </h5>
                        <p class="card-text">pedido del usuario {{$pedidos->vch_Nick}}</p>
                        <p class="card-text">precio : {{$pedidos->flt_Total}}</p>
                        <p class="card-text">Fecha : {{$pedidos->date_Fecha_Pedido}} </p>
                        @if ($pedidos->vch_Estado == 'En proceso')
                        <p class="card-text">Estado : <span class="badge badge-info">{{$pedidos->vch_Estado}} </span> </p>
                        @else
                        <p class="card-text">Estado : <span class="badge badge-success">{{$pedidos->vch_Estado}} </span> </p>
                        @endif
                       
                    </div>
                    <div class="card-footer ">
                        <a href="{{ route('pedidos-detalle',$pedidos->id) }}" class="btn btn-primary btn-lg btn-block">Ver Pedido</a>
                    </div>
                </div>
                <br></br> 
            </div> 
            @endforeach
           <hr>
           
            <!-- Tarjeta de pedido   2/2 -->
            

        </div>
        {{$data->links()}}
    </div>
</div>
