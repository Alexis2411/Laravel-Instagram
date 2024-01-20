<?php
namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;
use Storage;
use File;
class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request)
        {

            // Validation
            $validate = $this->validate($request, [
                'description' => 'required',
                'image_path' => 'required|image'
            ]);

            // Recoger los datos
            $description = $request->input('description');
            $user = Auth::user();

            $image = new Image();
            $image->user_id = $user->id;
            $image->description = $description;

            if ($image_path = $request->file('image_path')) {
                $image_path_name = time() . $image_path->getClientOriginalName();
                Storage::disk('images')->put($image_path_name, File::get($image_path));
                $image->image_path = $image_path_name;
            }

            $image->save();

            // Redireccion
            return redirect()->route('home')->with(['message' => 'La foto ha sido subida correctamente']);
        }

        public function getImage($filename)
        {
            $file = Storage::disk('images')->get($filename);
            return new Response($file, 200);
        }
}
