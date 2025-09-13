<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Utils\Util;
use Mail;
use App\Mail\AcknowledgementEmail;
use DB;
class SupportTicketController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $util;

    /**
     * Constructor
     *
     * @param Util $util
     * @return void
     */
    public function __construct(Util $util)
    {
        $this->util = $util;
    }
    public function post(Request $request)
    {
        try {
            $input_data = $request->only(['customer_name','problem_description','email','phone']);
            $input_data['ref_no'] = $this->util->generateReference();
            $ticket = SupportTicket::create($input_data);

            Mail::to($ticket->email)->send(new AcknowledgementEmail([
                'customer_name' => $ticket->customer_name ?? '',
                'ref_no' => $ticket->ref_no ?? '',
            ]));
            
            $output = ['success' => 1,
                            'msg' => __('Ticket Created Successfully'), 
                            'data' => $ticket 
                        ];
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' =>  $e->getMessage()
                        ];
        }

        return $output;
    }

    public function search()
    {
        return view('search');
    }

    public function postSeach(Request $request)
    {
        $term = request()->term;

        $ticket = SupportTicket::orderBy('id')
        ->where('ref_no', $term)->with(['comments', 'comments.agent'])->first();

        $html = '';
        if(isset($ticket))
        {
            $html =  view('partials.result',compact(
                        'ticket'
                    ))->render();
        }
        else
        {
            $html =  view('partials.error')->render();
        }

        
        return $html;            

    }
}
