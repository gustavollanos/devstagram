<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request,[
            //'username' =>'required|unique:users|min:3|max:20|not_in:twitter,editar-perfil',
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'unique:users,email,'.auth()->user()->id, 'email'],
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        
        }

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);

                
        if(!$request->password_c == '')
        {
            if (Hash::check($request->password_c, $usuario->password)) {
                //dd($request->password_confirmation);
                if($request->password === $request->password_confirmation)
                {
                    $usuario->password = $request->password;
                    $usuario->username = $request->username;
                    $usuario->email = $request->email;
                    $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
                    $usuario->save();
                    //return redirect()->route('posts.index', auth()->user()->username);
                    return redirect()->route('posts.index', $usuario->username);
                }
                return back()->with('mensaje', 'Credenciales nuevas no coinciden'); 
    
                
            }
                return back()->with('mensaje', 'Credenciales Incorrectas');
                //dd('Credenciales incorrectas');
        } else
        {
            $usuario->username = $request->username;
            $usuario->email = $request->email;
            $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
            $usuario->save();
            //Redireccionar
            return redirect()->route('posts.index', $usuario->username); 
        }


    }

}
