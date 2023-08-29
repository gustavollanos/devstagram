@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if (session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2
                text-center">
                    {{ session('mensaje') }}</p>
                @endif

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" id="username" name="username" placeholder="Tu Nombre de Usuario" 
                        class="border p-3 w-full rounded-lg @error('username') border-red-500                         
                        @enderror" value="{{ auth()->user()->username }}">
                        @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2
                        text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input type="text" id="email" name="email" placeholder="Tu Correo electrónico" 
                        class="border p-3 w-full rounded-lg @error('email') border-red-500                         
                        @enderror" value="{{ auth()->user()->email }}">
                        @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2
                        text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    <input type="file" id="imagen" name="imagen" accept=".jpg, .jpeg, .png" value=""
                        class="border p-3 w-full rounded-lg">
                </div>

                <div class="mb-5">
                    <label for="password_c" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password Actual
                    </label>
                    <input type="password" id="password_c" name="password_c" placeholder="Tu Password Actual" 
                        class="border p-3 w-full rounded-lg @error('password_c') border-red-500                         
                        @enderror" value="">
                        @error('password_c')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2
                        text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2
                    text-center">{{ $message }}</p>
                    @enderror
                    <input type="password" id="password" name="password" placeholder="Password de Registro" 
                        class="border p-3 w-full rounded-lg @error('password') border-red-500                      
                        @enderror"> 
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                        placeholder="Repite tu Password" class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500                         
                        @enderror">
                </div>

                <input type="submit" value="Guardar Cambios" 
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase
                font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>
    </div>
@endsection
