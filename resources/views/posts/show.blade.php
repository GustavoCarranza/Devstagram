@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection


@section('contenido')
    
    <div class="container mx-auto md:flex ">
        
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="imagen del post {{$post->titulo}}">
        <div class="p-3 flex items-center gap-4">
            @auth

            <livewire:like-post :post="$post" />

            @endauth
            </div>

            <div>
                <p class="font-bold"> {{$post->user->username }} </p>
                <p class="text-sm text-gray-500">
                    {{$post->created_at->diffForHumans()}}
                </p>
                <p class="mt-5 mb-6">
                    {{$post->descripcion}}
                </p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form method="post" action="{{route('posts.destroy',$post)}}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar publicacion" class="bg-red-600 hover:bg-red-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"> 
                    </form>
                @endif
            @endauth

        </div>

        <div class="md:w-6/12 p-5">
            
            <div class="shadow bg-white p-5 mb-5">
                @auth
                <p class="text-xl font-bold text-center mb-4">Agrega un comentario</p>
                @if (session('mensaje'))
                    <div class="bg-green-500 rounded-lg p-2 mb-6 text-center text-white uppercase font-bold">
                        {{session('mensaje')}}
                    </div>
                @endif
            <form action="{{route('comentarios.store', ['post' => $post, 'user' => $user])}}" method="POST">
            @csrf
                <div class="mb-5">
                    <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                       Comentarios
                    </label>
                    <textarea name="comentario" id="comentario" placeholder="Agregar comentarios a la publicación" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"></textarea>
                    
                    @error('comentario')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <input type="submit" value="Agregar comentario" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"> 
            </form>
            @endauth
             
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user) }}">
                                  <p class="font-bold text-xl text-gray-800 border-b border-gray-500 mb-3 hover:text-blue-900 transition-colors">  {{$comentario->user->username}} 
                                  </p>
                                </a>
                                <p class="font-bold text-gray-600"> {{$comentario->comentario}} </p>
                                <p class="text-gray-500 text-sm"> {{$comentario->created_at->diffForHumans()}} </p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios aun</p>   
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection