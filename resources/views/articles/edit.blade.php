<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mx-auto w-1/2 bg-gray-200 rounded-xl shadow-lg px-2 py-4">
                <form name="as" action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-jet-label>Nombre</x-jet-label>
                    <x-jet-input type="text" name="nombre" placeholder="Nombre del artículo.." class="w-full"
                        value="{{ old('nombre', $article->nombre) }}" />
                    <x-jet-input-error for="nombre"></x-jet-input-error>
                    <x-jet-label>Descripción</x-jet-label>
                    <textarea name="descripcion" rows="4"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                    focus:ring-opacity-50 rounded-md shadow-sm mt-2 w-full">{{ old('descripcion', $article->descripcion) }}</textarea>
                    <x-jet-input-error for="descripcion"></x-jet-input-error>
                    <x-jet-label>Precio</x-jet-label>
                    <x-jet-input type="number" name="precio" step="0.01" placeholder="Precio.." class="w-full"
                        value="{{ old('precio', $article->precio) }}" />
                    <x-jet-input-error for="precio"></x-jet-input-error>
                    <x-jet-label>Stock</x-jet-label>
                    <x-jet-input type="number" name="stock" step="1" placeholder="Stock(en unidades).."
                        class="w-full" value="{{ old('stock', $article->stock) }}" />
                    <x-jet-input-error for="stock"></x-jet-input-error>

                    <x-jet-label>Imagen del Artículo</x-jet-label>
                    <div class="flex justify-center">
                        <div class="mb-3 w-96">
                            <input
                                class="form-control
                          block
                          w-full
                          px-3
                          py-1.5
                          text-base
                          font-normal
                          text-gray-700
                          bg-white bg-clip-padding
                          border border-solid border-gray-300
                          rounded
                          transition
                          ease-in-out
                          m-0
                          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                type="file" id="imagen" name="imagen" accept="image/*">
                        </div>
                    </div>
                    <x-jet-input-error for="imagen"></x-jet-input-error>
                    <div class="mt-2 mx-auto">
                        <img src="{{ Storage::url($article->imagen) }}" id="img" 
                        class="object-cover object-center" alt="imagen por defecto">
                    </div>
                    <div class="flex flex-row-reverse">
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-edit"> Editar</i>
                        </button>
                        <a href="{{route('dashboard')}}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa-solid fa-xmark"> Cancelar</i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>