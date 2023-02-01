<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="rounded-lg shadow-lg bg-white max-w-sm">
                    <img class="rounded-t-lg" src="{{ Storage::url($article->imagen) }}" alt="" />
                    <div class="p-5">
                        <h5 class="text-gray-900 text-xl font-medium mb-2">Nombre: {{ $article->nombre }}</h5>
                        <p class="text-gray-700 text-base mb-4">
                            Descripción: {{ $article->descripcion }}
                        </p>
                        <p class="text-gray-700 text-base mb-4">
                            Precio: {{ $article->precio }}
                        </p>
                        <p class="text-gray-700 text-base mb-4">
                            Stock: {{ $article->stock }}
                        </p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            <span class="font-bold">
                                Publicado: </span> {{ $article->created_at->format('d/m/y h:i:s') }}</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            <span class="font-bold">
                                Actualizado: </span> {{ $article->updated_at->format('d/m/y h:i:s') }}</p>
                        <a href="{{ route('dashboard') }}"
                            class=" bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-backward"> Volver</i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
