<?php

namespace App\Http\Controllers\Web;

use Aex\Packagetest\Facades\Packagetest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $uriArr = explode(DIRECTORY_SEPARATOR, $_SERVER['REQUEST_URI']);

        return ($uriArr);
        //return '学生列表';
    }


    /**
     * @param Request $request
     * @return string
     */
    public function test(Request $request){
        return 'hello world';
//        $a = Packagetest::test_rtn('Aex');
//        return view('Packagetest::packagetest',['msg'=>$a]);
    }
}
