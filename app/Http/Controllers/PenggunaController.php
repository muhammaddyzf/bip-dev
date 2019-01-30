<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengguna;
use App\KategoriPengguna;
use App\User;
use App\Images;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth; 
use File;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $rand = rand(1000, 9000);
        $this->id        = 'PNGID'.$rand.date('His');
        $this->kode      = $rand.date('His');
        $this->dateInsert= date('Y-m-d H:i:s');
        $this->dateUpdate= date('Y-m-d H:i:s');
    }

    public function index()
    {
        return view('admin.pengguna.index');
    }

    public function getData()
    {
        $pengguna = User::all();

        $data = Datatables::of($pengguna)
        ->addColumn('name', function($row){
             return $html = '<a href="#" data-href="'.url('admin/pengguna/edit/').'" data-id="'.$row->id.'" onclick="actionButton(this)">'.$row->name.'</a>'; 
          })
          ->addColumn('action', function($row){
              $html = '<div class="text-center">
                        <a disabled href="#" onclick="confirmLink(this)" data-href="'.url('admin/pengguna/hapus/'.$row->id).'" data-text="Your previous data will change" type="button" class="btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>
                        </a>
                    </div>
                    ';
              return $html;
          })
          ->rawColumns(['name','action','confirmed'])
          ->make(true);

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriPengguna = KategoriPengguna::all();
        return view('admin.pengguna.add', compact('kategoriPengguna'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idUser = Auth::id();
        $request->validate([
            'nama'       => 'required', 
            'ktpng'      => 'required', 
            'nik'        => 'required', 
            'email'      => 'required|email', 
            'password'   => 'required', 
        ]);

        $username = User::getUserName($request->nama, date('His'));   
        $user     = User::create([
                    'name'     => $request->nama,
                    'email'    => $request->email,
                    'username' => $username,
                    'password' => bcrypt($request->password),
                  ]); 
        
        // $idPengguna = 'PNG    '.date('His');
        $pengguna = new Pengguna;
        $pengguna->PNG_ID       = $this->id;
        $pengguna->IKM_ID       = '';
        $pengguna->PNG_NIK      = $request->nik;
        $pengguna->PNG_PEND     = $request->pendidikan;
        $pengguna->PNG_TLP      = $request->tlp;
        $pengguna->PNG_ALMNT    = $request->alamat;
        $pengguna->PNG_EMAIL    = $request->email;
        $pengguna->USER_ID      = $user->id;
        $pengguna->KTPNG_ID     = $request->ktpng;
        $pengguna->PNG_NAMA     = $request->nama;
        $pengguna->PNG_DTINS    = $this->dateInsert;
        $pengguna->PNG_DTUPDT   = $this->dateUpdate;
        $pengguna->PNG_USERINS  = $user->id;
        $pengguna->PNG_USERUPDT = '';
        $pengguna->save();


        $token                  = $user->createToken($username)-> accessToken; 
        $updateToken            = User::find($user->id);
        $updateToken->token     = $token;
        $updateToken->save();



        $foto         = "";
        $originalName = "";
        if($request->hasFile('userImage')){
            $originalName    = $request->file('userImage')->getClientOriginalName();
        
            $imageName = time().'.'.$request->userImage->getClientOriginalExtension();
            $foto      = 'images/user/'.$imageName;

            $request->userImage->move(public_path('/images/user/'), $imageName);   
        }

        $rand = rand(1000, 9000);
        $images = new Images;   
        $images->IMG_ID        = 'IMG'.$rand.date('His'); 
        $images->ID            = $user->id; 
        $images->IMG_GROUP     = 'USER'; 
        $images->IMG_NAMA      = $foto; 
        $images->IMG_KET       = $originalName; 
        $images->IMG_DTINS     = $this->dateInsert;
        $images->IMG_DTUPDT    = $this->dateUpdate;
        $images->IMG_USERINS   = $idUser;
        $images->IMG_USERUPDT  = $idUser;

        $images->save();

        return redirect('admin/pengguna/list')->with('message','Transaction Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('pengguna', 'images', 'pengguna.kategoriPengguna')->where('id', $id)->first();
        $kategoriPengguna = KategoriPengguna::all();

        return view('admin.pengguna.edit', compact('user', 'kategoriPengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'       => 'required', 
            'nik'        => 'required', 
            'alamat'     => 'required', 
            'pendidikan' => 'required', 
            'tlp' => 'required', 
        ]);

        $hasher      = app()->make('hash');
        $oldPassword = "";
        $newPassword = "";
        $password    = "";

        $user = User::find($id);
        if($request->input('password') != ""){
            $newPassword = $hasher->make($request->input('password'));
            $password    = $newPassword;
        }else{
            $oldPassword = $user->password;
            $password    = $oldPassword;
        }

        //update user
        $user->id       = $id;
        $user->password = $password;
        $user->name     = $request->input('nama');
        $user->save();

        //update pengguna
        $pengguna = Pengguna::where('USER_ID', $id)
                    ->update([
                        'PNG_NAMA'      => $request->input('nama')
                        , 'PNG_TLP'     => $request->input('tlp')
                        , 'PNG_PEND'    => $request->input('pendidikan')
                        , 'PNG_ALMNT'   => $request->input('alamat')
                        , 'PNG_NIK'     => $request->input('nik')
                        , 'PNG_USERUPDT'=> $id

                    ]);

        //update images
        $foto = "";
        if($request->hasFile('userImage')){
            $getImages       = Images::where('ID', $id)->first();
            $originalName    = $request->file('userImage')->getClientOriginalName();
            // $sizeFile        = getimagesize($originalName);

            $imageName = time().'.'.$request->userImage->getClientOriginalExtension();
            $foto      = 'images/user/'.$imageName;

            if(isset($getImages)){

              if($getImages->IMG_NAMA == ""){
                  $request->userImage->move(public_path('/images/user/'), $imageName);
              }else{
                  File::delete(public_path($getImages->IMG_NAMA));
                  $request->userImage->move(public_path('/images/user/'), $imageName);
              }


              $images = Images::where('ID', $id)
                      ->update([
                            'IMG_NAMA'      => $foto,
                            'IMG_DTUPDT'    => $this->dateUpdate,
                            'IMG_USERUPDT'  => $id,
                      ]);
            }else{
                $request->userImage->move(public_path('/images/user/'), $imageName);


                $rand = rand(1000, 9000);
                $images = new Images;   
                $images->IMG_ID        = 'IMG'.$rand.date('His'); 
                $images->ID            = $id; 
                $images->IMG_GROUP     = 'User'; 
                $images->IMG_NAMA      = $foto; 
                $images->IMG_KET       = $originalName; 
                $images->IMG_DTINS     = $this->dateInsert;
                $images->IMG_DTUPDT    = $this->dateUpdate;
                $images->IMG_USERINS   = $id;
                $images->IMG_USERUPDT  = $id;

                $images->save();
            }

        }

        return redirect('admin/pengguna/list')->with('message','Transaction Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Images::where('ID', $id)->delete();
        $pengguna = Pengguna::where('USER_ID', $id)->delete();
        $user = User::where('id', $id)->delete();

        return redirect('admin/pengguna/list')->with('message','Transaction Success');
    }
}
