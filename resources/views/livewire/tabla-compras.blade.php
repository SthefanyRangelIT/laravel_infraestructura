<div>
    {{-- Boton agregar --}}
    <div class="flex flex-row">
        <div class="flex flex-col">
            <x-jet-button class="mt-3" wire:click="openAgregarModal">
                {{ __('+  Agregar compras')}}
            </x-jet-button>
        </div>
        <div class="flex flex-col">
            <x-jet-button class="mt-3" wire:click="exportarCompras">
                {{ __('Exportar compras a excel')}}
            </x-jet-button>
        </div>
    </div>

    {{-- Tabla --}}
    <div class="flex flex-row">
        <div class="flex flex-col w-full">
            <table id="tabla_compras" class="w-full">
                <thead>
                    <tr>
                        <th>Fecha de compra</th>
                        <th>Monto</th>
                        <th>Descripción</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @forelse ($compras as $compra)
                            <td>{{ $compra->fecha_compra}}</td>
                            <td>{{ $compra->monto}}</td>
                            <td>{{ $compra->descripcion}}</td>
                            <td>
                                {{ $compra->empresa}}
                                {{ $compra->giro}}
                            </td>
                            <td>
                                <x-jet-button wire:click="openEditarModal({{ $compra->id_compra }})">Editar</x-jet-button>
                                <x-jet-button wire:click="openEliminarModal({{ $compra->id_compra }})">Eliminar</x-jet-button>
                            </td>
                        @empty
                            <td colspan="5">Sin compras registradas</td>
                        @endforelse
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Agregar modal --}}
    <x-jet-dialog-modal wire:model="agregar_modal">
        <x-slot name="title">
            {{ __('Agregar compra') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-input type="date" class="mt-1 block w-3/4" placeholder="{{ __('Fecha de compra') }}" wire:model.defer="fecha_compra" />
                <x-jet-input-error for="fecha_compra" class="mt-2" />

                <div class="flex flex-wrap items-stretch w-3/4 mb-4 relative mt-2">
                    <div class="flex -mr-px">
                        <span class="flex items-center leading-normal bg-grey-lighter rounded rounded-r-none border border-r-0 border-grey-light px-3 whitespace-no-wrap text-grey-dark text-sm">$</span>
                    </div>
                    <input type="text" id="monto" name="monto" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" placeholder="Monto" wire:model.defer="monto">
                </div>
                <x-jet-input-error for="monto" class="mt-2" />

                <textarea rows="10" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow mt-1 block w-3/4" placeholder="{{ __('Descripción') }}" wire:model.defer="descripcion"></textarea>
                <x-jet-input-error for="descripcion" class="mt-2" />

                <select name="id_proveedor" id="id_proveedor" wire:model.defer="id_proveedor" class="mt-2 flex-shrink flex-grow flex-auto leading-normal w-3/4 flex-1 border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow">
                    @forelse ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->empresa }}</option>
                    @empty
                        <option value="">sin proveedores disponibles</option>
                    @endforelse
                </select>
                <x-jet-input-error for="id_proveedor" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('agregar_modal')" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="agregarCompra" wire:loading.attr="disabled">
                {{ __('Agregar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Editar modal --}}
    <x-jet-dialog-modal wire:model="editar_modal">
        <x-slot name="title">
            {{ __('Editar compra') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-input type="date" class="mt-1 block w-3/4" placeholder="{{ __('Fecha de compra') }}" wire:model.defer="fecha_compra" />
                <x-jet-input-error for="fecha_compra" class="mt-2" />

                <x-jet-input type="text" class="mt-1 block w-3/4" placeholder="{{ __('Monto') }}" wire:model.defer="monto" />
                <x-jet-input-error for="monto" class="mt-2" />

                <textarea rows="10" class="mt-1 block w-3/4" placeholder="{{ __('Descripción') }}" wire:model.defer="descripcion"></textarea>
                <x-jet-input-error for="descripcion" class="mt-2" />

                <select name="id_proveedor" id="id_rpoveedor" wire:model.defer="id_proveedor">
                    @forelse ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->empresa }}</option>
                    @empty
                        <option value="">sin proveedores disponibles</option>
                    @endforelse
                </select>
                <x-jet-input-error for="id_proveedor" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('editar_modal')" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="editarCompra" wire:loading.attr="disabled">
                {{ __('Editar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Eliminar modal --}}
    <x-jet-dialog-modal wire:model="eliminar_modal">
        <x-slot name="title">
            {{ __('Agregar compra') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                {{ __('¿Está seguro de eliminar la siguiente compra?')}}
                <x-jet-label><strong>Fecha de compra: </strong>{{ $fecha_compra }}</x-jet-label>
                <x-jet-label><strong>Monto: </strong>{{ $monto }}</x-jet-label>
                <x-jet-label><strong>Descripción: </strong>{{ $descripcion }}</x-jet-label>
                <x-jet-label><strong>Proveedor: </strong>{{ $empresa }} - {{ $giro }}</x-jet-label>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('eliminar_modal')" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="eliminarCompra" wire:loading.attr="disabled">
                {{ __('Sí, Eliminar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- confirmacion modal --}}
    <x-jet-dialog-modal wire:model="confirmacion_modal">
        <x-slot name="title">
            {{ $confirmacion_message }}
        </x-slot>

        <x-slot name="content">

        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button class="ml-2" wire:click="$toggle('confirmacion_modal')" wire:loading.attr="disabled">
                {{ __('Ok, cerrar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
