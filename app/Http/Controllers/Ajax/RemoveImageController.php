<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class RemoveImageController extends Controller
{
    public function __invoke(Image $image)
    {
        try {
            $image->delete();
            return response()->json(['message' => 'Image was removed']);
        } catch (\Exception $exception) {
            logs()->error($exception);
            return response(status: 422)->json(['message' => $exception->getMessage()]);
        }
    }
}
