<?php

namespace App\Exceptions;

use Exception;

class OutOfStockException extends Exception
{
   
   /**
 * Render an exception into an HTTP response.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Exception  $exception
 * @return \Illuminate\Http\Response
 */
public function render($request, Exception $exception)
{
    // dd($request);
    if ($exception instanceof CustomException) {
        // dd('df');
        return response()->json([
                'success' => 'false',
                'type' => 'out_of_stock',
                'msg' => 'Quantity is more than stock'
            ]);
    }
    return false;
    dd('tdd');
 
    // return parent::render($request, $exception);
}

}
