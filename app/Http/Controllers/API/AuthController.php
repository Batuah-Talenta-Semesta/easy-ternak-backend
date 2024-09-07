<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;
  /**
     * @OA\Info(
 *     title="Easy Ternak API",
 *     version="1.0.0",
 *     description="A simple API for demonstration purposes Easy Ternak Api Aplication"
 * )**/
class AuthController extends BaseController
{
    // php artisan l5-swagger:generate
    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     tags={"Auth"}, 
     *     summary="Register a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="hendynursholeh713@gmail.com"),
     *             @OA\Property(property="username", type="string", example="hendy25"),
     *             @OA\Property(property="password", type="string", format="password", example="password123"),
     *             @OA\Property(property="c_password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="User registered successfully."),
     *             @OA\Property(property="data", type="object", additionalProperties={"type":"string"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Validation Error."),
     *             @OA\Property(property="errors", type="object", additionalProperties={"type":"array", "items":{"type":"string"}})
     *         )
     *     )
     * )
     */
    public function register(Request $request) {
        // Validasi input dengan custom message
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => [
                'required',
                'unique:users,username',
                'regex:/^\S*$/u' // regex untuk melarang spasi
            ],
            'password' => 'required',
            'c_password' => 'required|same:password',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'username.regex' => 'Username tidak boleh mengandung spasi.',
            'password.required' => 'Kata sandi wajib diisi.',
            'c_password.required' => 'Konfirmasi kata sandi wajib diisi.',
            'c_password.same' => 'Konfirmasi kata sandi tidak sesuai dengan kata sandi.'
        ]);
    
        // Jika validasi gagal, ambil pesan error pertama per field
        if ($validator->fails()) {
            $errors = $validator->errors();
            $firstErrors = [];
    
            foreach ($errors->keys() as $key) {
                $firstErrors[$key] = $errors->first($key);
            }
    
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $firstErrors // Mengembalikan hanya pesan error pertama per field
            ], 422);
        }
    
        // Ambil data input
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
    
        // Buat pengguna baru
        $user = User::create($input);
        $success['user'] = $user;
    
        // Kembalikan respons sukses dengan status 201 Created
        return response()->json([
            'status' => 'success',
            'message' => 'Pengguna berhasil didaftarkan.',
            'data' => $success
        ], 201);
    }
    
    

    public function test(){
        echo "hahha";
        
    }


    /**
 * @OA\Post(
 *     path="/api/auth/login",
 *     tags={"Auth"}, 
 *     summary="Log in a user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="username", type="string", example="otong"),
 *             @OA\Property(property="password", type="string", format="password", example="otong123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User logged in successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="User logged in successfully."),
 *             @OA\Property(property="token", type="string", example="your_jwt_token_here")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Invalid credentials.")
 *         )
 *     )
 * )
 */
public function login()
{
    // Mengambil kredensial username dan password
    $credentials = request(['username', 'password']);

    // Autentikasi menggunakan kolom username
    if (! $token = auth()->attempt($credentials)) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized',
            'data' => ['error' => 'Unauthorized']
        ], 401);
    }

    // Mendapatkan token dan mengembalikan respons sukses
    $success = $this->respondWithToken($token);

    return response()->json([
        'success' => true,
        'message' => 'User login successfully.',
        'data' => $success
    ], 200);
}



    public function profile() {
        $success = auth()->user();
   
        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     tags={"Auth"}, 
     *     summary="Log out a user",
     *     @OA\Response(
     *         response=200,
     *         description="User logged out successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="User logged out successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Unauthorized action.")
     *         )
     *     )
     * )
     */
    public function logout() {
        auth()->logout();
        
        return $this->sendResponse([], 'Successfully logged out.');
    }

    public function refresh() {
        $success = $this->respondWithToken(auth()->refresh());
   
        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    protected function respondWithToken($token) {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}