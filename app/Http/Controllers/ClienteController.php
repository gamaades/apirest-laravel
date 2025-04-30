<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function index()
    {
        $json = array(
            'detalle'=> 'No encontrado'
        );

        echo json_encode($json, true);
    }

    // crear un registro
    public function store(Request $request)
    {
        $datos = array(
            'primer_nombre' => $request->input('primer_nombre'),
            'primer_apellido' => $request->input('primer_apellido'),
            'email' => $request->input('email'),
        );

        $validated = Validator::make($request->all(), [
            'primer_nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'email' => 'required|email|email:rfc,dns|max:255|unique:clientes',
        ]);

        // Si falla la validacion
        if ($validated->fails()) {
            // return response()->json(['detalle' => 'Registro no válido'], 400);
            return response()->json([
                'detalle' => 'Registro no valido',
                'errores' => $validated->errors()
            ], 400);
        } else {
            $id_cliente = Hash::make($datos['primer_nombre'] . $datos['primer_apellido'] . $datos['email']);
            $llave_secreta = Hash::make($datos['email'] . $datos['primer_apellido'] . $datos['primer_nombre'], ['rounds' => 12]);
            echo '<pre>'; print_r($id_cliente); echo '</pre>';
            echo '<pre>'; print_r($llave_secreta); echo '</pre>';
            // return response()->json([
            //     'detalle' => 'Registro creado con éxito',
            //     'datos' => $request->only('primer_nombre', 'primer_apellido', 'email')
            // ], 201);
        }

    }
}
