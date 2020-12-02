<div class="p-6">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="CLV_Categoria_carga">Cargar por categoria</label>
            <select class="form-control" id="CLV_Categoria_carga" wire:model.debounde.800ms="CLV_Categoria_carga">
                <option placeholder>TODOS los platillos</option>
                @foreach ($categoria as $cate)
                    <option value="{{ $cate->id }}">{{ $cate->vch_Categoria }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">

        </div>
        <div class="form-group col-md-2 flex justify-end items-center px-4 text-right sm:px-4">
            <x-jet-button wire:click="createShowModal">
                {{ __('Crear un platillo') }}
            </x-jet-button>
        </div>
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
                                    ID </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Nombres </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Presentacion</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Precio</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Categoria</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500
                                    uppercase tracking-wider">
                                    Imagen</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                                @foreach ($data as $platillo)
                                    <tr>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $platillo->id }}</td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $platillo->vch_Nombre }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                            {{ $platillo->vch_Presentacion }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $platillo->flt_Precio }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $platillo->vch_Categoria }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap"><img
                                                src="{{ asset('storage/platillo_upload/' . $platillo->vch_Imagen) }}"
                                                width="200" height="200" alt="datos" />
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm">
                                            <x-jet-secondary-button wire:click="updateShowModal({{ $platillo->id }})">
                                                <x-icon-update />
                                            </x-jet-secondary-button>

                                            <x-jet-danger-button
                                                wire:click="deleteShowModal({{ $platillo->id }})">
                                                <x-icon-delete />
                                            </x-jet-danger-button>

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

    <br />

    {{ $data->links() }}

    {{-- Modal categorias --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            @if ($modalId)
                {{ __('Actualizar Platillos') }}
            @else
                {{ __('Insetar Platillos') }}
            @endif



        </x-slot>

        <x-slot name="content">

            <div class="mt-4">
                <x-jet-label for="vch_Nombre" value="{{ __('Nombre') }}" />
                <x-jet-input id="vch_Nombre" class="block mt-1 w-full" type="text"
                    wire:model.debounde.800ms="vch_Nombre" />
                @error('vch_Nombre') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="vch_Presentacion" value="{{ __('Presentacion') }}" />
                <x-jet-input id="vch_Presentacion" class="block mt-1 w-full" type="text"
                    wire:model.debounde.800ms="vch_Presentacion" />
                @error('vch_Presentacion') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="flt_Precio" value="{{ __('Precio') }}" />
                <x-jet-input id="flt_Precio" class="block mt-1 w-full" type="number"
                    wire:model.debounde.800ms="flt_Precio" />
                @error('flt_Precio') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="CLV_Categoria" value="{{ __('Categoria') }}" />

                <select class="block mt-2 w-full" id="CLV_Categoria" wire:model.debounde.800ms="CLV_Categoria">
                    <option placeholder>seleciionar</option>
                    @foreach ($categoria as $cate)
                        <option value="{{ $cate->id }}">{{ $cate->vch_Categoria }}</option>
                    @endforeach
                </select>
                @error('CLV_Categoria') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="vch_Imagen" value="{{ __('Seleccione una imagen') }}" />
                <x-jet-input id="vch_Imagen{{ $iteration }}" class="block mt-1 w-full" type="file"
                    wire:model.debounde.800ms="vch_Imagen" />
                @error('vch_Imagen') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
            </div>

            <div class="items-center mt-4 text-center">

                @if ($modalId)
                    Vista previa de le imagen Actual del Registro:
                    <center>
                        <img width="150" height="150" src="{{ asset('storage/platillo_upload/' . $img_temp) }}">
                    </center>
                @endif
                <br><br><br>
                @if ($vch_Imagen)
                    Vista previa de le imagen:
                    <center>
                        <img width="150" height="150" src="{{ $vch_Imagen->temporaryUrl() }}">
                    </center>
                @endif



                @error('vch_Imagen') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
                <div wire:loading wire:target="vch_Imagen" class="text-sm text-gray-500 italic">
                    <center><img src="{{ asset('storage/img_carga.gif') }}" width="50" height="50" alt=""></center>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-jet-secondary-button>
            @if ($modalId)
                <x-jet-danger-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Actualizar') }}
                </x-jet-danger-button>
            @else
                <x-jet-danger-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Insertar') }}
                </x-jet-danger-button>
            @endif

        </x-slot>
    </x-jet-dialog-modal>

    {{-- Modal Eliminar Usuario --}}
    <x-jet-dialog-modal wire:model="modal_ConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Eliminar una Persona') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Estas seguro de eliminar esta Persona.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modal_ConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Modal confirm --}}
    @if (session()->has('message_t'))
        <x-jet-dialog-modal wire:model="Confirma">
            <x-slot name="title">
                <center>
                    {{ session('message_t') }}
                </center>
            </x-slot>

            <x-slot name="content">
                <center>
                    <img src="{{ asset('storage/success-2.gif') }}" class="img-fluid" alt="Responsive image" width="250"
                        height="250">
                </center>
            </x-slot>

            <x-slot name="footer">

            </x-slot>
        </x-jet-dialog-modal>
    @endif

    @if (session()->has('message'))
        <x-jet-dialog-modal wire:model="Confirma">
            <x-slot name="title">

                {{ session('message') }}

            </x-slot>

            <x-slot name="content">
                <img src="{{ asset('storage/wrong.gif') }}" class="img-fluid" alt="Responsive image" width="250"
                    height="250">
            </x-slot>

            <x-slot name="footer">

            </x-slot>
        </x-jet-dialog-modal>
    @endif

</div>
