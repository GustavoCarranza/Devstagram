@extends('layouts.app')

@section('titulo')
    Registrate en DevStagram    
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
         
        <div class="md:w-6/12 p-5">
            <img src="{{asset('img/registrar.jpg')}}" alt="Imagen registro usuarios">
        </div>

        <div class="md:w-5/12 bg-white p-6 rounded-lg shadow-lg">
            <form action="{{ route('crear-cuenta')}}" method="POST">
                @csrf
                
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre 
                    </label>
                    <input type="text" name="name" id="name" placeholder="Ingresar nombre" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{old('name')}}">
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Usuario
                    </label>
                    <input type="text" name="username" id="username" placeholder="Ingresar usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{old('username')}}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>
                    @enderror
                </div>  

                <div class="mb-5">
                    <label for="email" class="mb -2 block uppercase text-gray-500 font-bold">
                        Ingresar correo electronico
                    </label>
                    <input type="text" name="email" id="email" placeholder="Ingresar correo" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>
                    @enderror
                </div> 

                <div class="mb-5">
                    <label for="password" class="mb -2 block uppercase text-gray-500 font-bold">
                        Ingresar Contraseña
                    </label>
                    <input type="password" name="password" id="password" placeholder="Ingresar contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                        </p>
                    @enderror
                </div> 

                <div class="mb-5">
                    <label for="password_confirmation" class="mb -2 block uppercase text-gray-500 font-bold">
                        Confirmar contraseña
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña" class="border p-3 w-full rounded-lg">
                </div>

                <input type="submit" value="Crear cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"> 
                 
            </form>
        </div>

    </div>
@endsection