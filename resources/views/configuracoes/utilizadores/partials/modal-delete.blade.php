
<x-modal name="confirm-user-deletion{{$item->id}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('roles.destroy',$item->id) }}" class="p-6">
        @csrf
        @method('DELETE')
        <div class="m-6 justify-center">

        <h2 class="text-lg font-medium text-gray-900">
            Tem certeza que deseja apagar este registro?
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Apos apagar todos registros relacionados a este serao apagados permanentemente do sistem.
        </p>
        </div>

        <div class="m-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ms-3">
                Excluir
            </x-danger-button>
        </div>
    </form>
</x-modal>
