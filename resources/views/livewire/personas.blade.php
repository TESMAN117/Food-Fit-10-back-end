<div class="p-6">
   
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
                                    ID </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Nombres </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Apellido Paterno</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Apellido Paterno</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Direccion</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500
                                    uppercase tracking-wider">
                                    Telefono</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                                @foreach ($data as $persona)
                                    <tr>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $persona->id }}</td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $persona->vch_Nombres }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $persona->vch_A_Paterno }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $persona->vch_A_Materno }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $persona->vch_Direccion }}
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-no-wrap">{{ $persona->vch_Telefono }}
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm">
                                            <x-jet-secondary-button wire:click="updateShowModal({{ $persona->id }})">
                                                <x-icon-update />
                                            </x-jet-secondary-button>

                                            <x-jet-danger-button class="ml-2"
                                                wire:click="deleteShowModal({{ $persona->id }})">
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
                {{ __('Actualizar Persona') }}
            @else
                {{ __('Insetar Persona') }}
            @endif



        </x-slot>

        <x-slot name="content">

            <div class="mt-4">
                <x-jet-label for="Nombres" value="{{ __('Nombres') }}" />
                <x-jet-input id="Nombres" class="block mt-1 w-full" type="text" wire:model.debounde.800ms="Nombres" />
                @error('Nombres') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="A_Paterno" value="{{ __('Apellido Paterno') }}" />
                <x-jet-input id="A_Paterno" class="block mt-1 w-full" type="text"
                    wire:model.debounde.800ms="A_Paterno" />
                @error('A_Paterno') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="A_Materno" value="{{ __('Apellido Materno') }}" />
                <x-jet-input id="A_Materno" class="block mt-1 w-full" type="text"
                    wire:model.debounde.800ms="A_Materno" />
                @error('A_Materno') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="Direccion" value="{{ __('Direccion') }}" />
                <textarea id="Direccion" class="block mt-2 w-full" type="text" wire:model.debounde.800ms="Direccion">
                </textarea>
                @error('Direccion') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="Telefono" value="{{ __('Telefono') }}" />
                <x-jet-input id="Telefono" class="block mt-1 w-full" type="text" wire:model.debounde.800ms="Telefono" />
                @error('Telefono') <span class="text-sm text-red-500 italic">{{ $message }}</span> @enderror
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
