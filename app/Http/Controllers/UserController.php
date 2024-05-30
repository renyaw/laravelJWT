<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }


    public function list(request $request){
        // Membuat Search
        $user_query = User::with(['user']);
        if($request->nama){
            $user_query->where('name','LIKE', '%'.$request->nama.'%');
        }
        if($request->email){
            $user_query->where('email','LIKE', '%'.$request->email.'%');
        }
        if($request->tempat){
            $user_query->where('tempat_lahir','LIKE', '%'.$request->tempat.'%');
        }

        // Sort atau mengurutkan
        if($request->urutkan && in_array($request->urutkan, ['id', 'created_at'])){
            $urutkan = $request->urutkan;
        } else{
            $urutkan ='id';
        }

        // Mengurutkan berdasarkan ascending atau descending | default adalah descending
        if($request->urutanOrder && in_array($request->urutanOrder, ['asc', 'desc'])){
            $urutanOrder = $request->urutanOrder;
        } else{
            $urutanOrder ='desc';
        }

        // Pagination
        if($request->jumlah){
            $jumlah=$request->jumlah;
        }else{
            $jumlah=3;
        }

        if($request->paginate){
            $users = $user_query->orderBY($urutkan, $urutanOrder)->paginate($jumlah);
        }else{
            $users = $user_query->orderBY($urutkan, $urutanOrder)->get();
        }

        return response()->json([
            'message' => 'User successfully fetched',
            'data' => $users
        ], 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = new User;
        $user->name = request()->name;
        $user->email = request()->email;
        $user->password = bcrypt(request()->password);
        $user->tempat_lahir = request()->tempat_lahir;
        $user->tanggal_lahir = request()->tanggal_lahir;
        $user->save();

        if($user){
            return response()->json(['message' => 'Pendaftaran Berhasil']);
        } else{
            return response()->json(['message' => 'Pendaftaran gagal']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        if ($request->has('tempat_lahir')) {
            $user->tempat_lahir = $request->tempat_lahir;
        }
        if ($request->has('tanggal_lahir')) {
            $user->tanggal_lahir = $request->tanggal_lahir;
        }

        $user->save();

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json("Yey berhasil dihapus");
    }
}
