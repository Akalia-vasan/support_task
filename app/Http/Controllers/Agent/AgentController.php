<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\SupportTicket;
use App\Models\Comment;
use Yajra\DataTables\Facades\DataTables;
use Mail;
use App\Mail\ReplyAcknowledgementEmail;
class AgentController extends Controller
{
    public function index(Request $request)
    {
        $tickets = SupportTicket::orderBy('id', 'DESC')
        ->select([
            'id',
            'ref_no',
            'customer_name',
            'email',
            'phone',
            'status',

        ])->get();

        if (request()->ajax()) {
            return Datatables::of($tickets)
            ->addColumn('action'
                ,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a type="button" href="{{route(\'agent.show\', [$id])}}">
                    <i class="fas fa-eye" style="color:blue;font-size:1.5rem;"></i>
                </a>'
            )
            ->addColumn('new_status', function($row){
                $status = 'New';
                if($row->status == 1)
                {
                    $status = 'Opened';
                }
                elseif($row->status == 2)
                {
                    $status = 'Replied';
                }
                elseif($row->status == 3)
                {
                    $status = 'Closed';
                }
                return '<span class="@status('.$row->status.')">'.$status.'</span>';
            })
            ->rawColumns(['action', 'new_status'])
            ->make(true);
        }
    }

    public function show($id)
    {
        $ticket = SupportTicket::where('id', $id)
        ->with(['comments', 'comments.agent'])->first();
        if($ticket->status == 0)
        {
            $ticket->status = 1;
            $ticket->save();
        }
        
        return view('agent.show', compact('ticket'));
    }

    public function reply(Request $request)
    {
        $input_data = $request->only(['comment', 'support_ticket_id']);

        $ticket = SupportTicket::find($input_data['support_ticket_id']);
        if($ticket->status == 1)
        {
            $ticket->status = 2;
            $ticket->save();
        }
        $input_data['created_by'] = auth()->user()->id;
        $comment = Comment::create($input_data);

        Mail::to($ticket->email)->send(new ReplyAcknowledgementEmail([
            'customer_name' => $ticket->customer_name ?? '',
            'ref_no' => $ticket->ref_no ?? '',
            'reply' => $input_data['comment'] ?? '',
        ]));

        $html = '';
        if(isset($ticket))
        {
            $html =  view('partials.reply',compact(
                        'comment'
                    ))->render();
        }
        
        
        return $html;
    }
}
