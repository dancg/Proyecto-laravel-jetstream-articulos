<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mx-auto w-1/2 bg-gray-200 rounded-xl shadow-lg px-2 py-4">
                <form name="as" action="{{ route('contacto.procesar') }}" method="POST">
                    @csrf
                    <x-jet-label>Nombre</x-jet-label>
                    <x-jet-input type="text" name="nombre" placeholder="Tu Nombre.." class="w-full"
                        value="{{ old('nombre') }}" />
                    <x-jet-input-error for="nombre"></x-jet-input-error>
                    <x-jet-label>Contenido del mensaje</x-jet-label>
                    <textarea name="contenido" rows="4"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                    focus:ring-opacity-50 rounded-md shadow-sm mt-2 w-full">{{ old('contenido') }}</textarea>
                    <x-jet-input-error for="contenido"></x-jet-input-error>
                    <div class="flex flex-row-reverse">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fa-solid fa-paper-plane"> Enviar</i>
                        </button>
                        <a href="{{route('dashboard')}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa-solid fa-xmark"> Cancelar</i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>