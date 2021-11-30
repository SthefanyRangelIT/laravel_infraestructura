<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <livewire:tabla-compras />

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#tabla_compras').DataTable({
                    columnDefs: [
                        { orderable: false, targets: 4 }
                    ]
                });
            } );
        </script>
    @endpush
</x-app-layout>
