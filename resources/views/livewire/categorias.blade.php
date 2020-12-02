<div class="p-6">
    @if (session()->has('message_pla'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{ session('message_pla') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
    @endif


    
    <div class="flex items-center justify-end px-4 text-right sm:px-6">

        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
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
                                    ID</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Descripcion</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    imagen</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                                @foreach ($data as $cat)
                                    <tr>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $cat->id }}</td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $cat->vch_Categoria }}</td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $cat->vch_Descripcion }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap"><img
                                                src="{{ asset('storage/categoria_upload/' . $cat->vch_Imagen) }}"
                                                width="200" height="200" class="img-fluid" alt="Responsive image" />
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm">
                                            <x-jet-secondary-button wire:click="updateShowModal({{ $cat->id }})">
                                                <x-icon-update />
                                            </x-jet-secondary-button>

                                            <x-jet-danger-button class="ml-2"
                                                wire:click="deleteShowModal({{ $cat->id }})">
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
                {{ __('Actualizar Caegoria') }}
            @else
                {{ __('Insetar Caegoria') }}
            @endif


        </x-slot>

        <x-slot name="content">

            <div class="mt-4">
                <x-jet-label for="vch_cat" value="{{ __('Categoria') }}" />
                <x-jet-input id="vch_cat" class="block mt-1 w-full" type="text" wire:model.debounde.800ms="vch_cat" />
                @error('vch_cat') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="vch_des" value="{{ __('Categoria') }}" />
                <textarea id="vch_des" class="block mt-2 w-full" type="text" wire:model.debounde.800ms="vch_des">
                </textarea>
                @error('vch_des') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="vch_img" value="{{ __('Seleccione una imagen') }}" />
                <x-jet-input id="vch_img{{ $iteration }}" class="block mt-1 w-full" type="file"
                    wire:model.debounde.800ms="vch_img" />
                @error('vch_img') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
            </div>

            <div class="items-center mt-4 text-center">

                @if ($modalId)
                    Vista previa de le imagen Actual del Registro:
                    <center>
                        <img width="150" height="150" src="{{ asset('storage/categoria_upload/' . $img_temp) }}">
                    </center>
                @endif
                <br><br><br>
                @if ($vch_img)
                    Vista previa de le imagen:
                    <center>
                        <img width="150" height="150" src="{{ $vch_img->temporaryUrl() }}">
                    </center>
                @endif



                @error('vch_img') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
                <div wire:loading wire:target="vch_img" class="text-sm text-gray-500 italic">
                    <center><img src="{{ asset('storage/img_carga.gif') }}" width="50" height="50" alt=""></center>
                </div>
            </div>



        </x-slot>

        <x-slot name="footer">
            <hr>
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
            {{ __('Eliminar una categoria') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Estas seguro de eliminar esta categoria.') }}
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
                 <img src="{{asset('storage/success-2.gif') }}" class="img-fluid" alt="Responsive image" width="250" height="250">
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
                <img src="{{asset('storage/wrong.gif') }}" class="img-fluid" alt="Responsive image" width="250" height="250">
            </x-slot>

            <x-slot name="footer">

            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>