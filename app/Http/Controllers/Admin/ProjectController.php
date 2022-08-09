<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Project;

use Barryvdh\DomPDF\Facade as PDF;
//use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Requirement;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use Exception;

class ProjectController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $projects = Project::orderby('created_at','desc')->latest('id');

            return Datatables::of($projects)
            ->editColumn('created_at',function(Project $project){
                return $project->created_at->diffForHumans();
            })
            
            ->addColumn('requirement',function(Project $project){
                return substr($project->requirement, 0, 100) ;
            })
            ->addColumn('priority',function(Project $project){
                //if($project->priority == 'low'){'dasdad'};
                return $project->priority;
            })
            ->addColumn('start_date',function(Project $project){
                return date('d-m-Y', strtotime($project->start_date));
            })
            ->addColumn('end_date',function(Project $project){
                return date('d-m-Y', strtotime($project->end_date));
            })
            ->addColumn('status',function(Project $project){
                return '<div class="media-body align-self-center">'
                            . Str::ucfirst($project->status).
                            '<span class="badge badge-info ml-2">'. $project->completion_status .'%</span>
                        </div>';
            })
            ->addColumn('action',function($data){
                $link = '<div class="d-flex">'.
                            '<a href="'.route('project.show',$data->id).'" class="badge badge-soft-success mr-2"><small>View</small></a>'.
                            '<a href="'.route('project.edit',$data->id).'" class="badge badge-soft-info mr-2"><small>Edit</small></a>'.
                            '<a href="javascript:void(0);" id="'.$data->id.'" class="badge badge-soft-danger delete"><small>Delete</small></a>'.
                        '</div>';
                return $link;
            })
            ->rawColumns(['action','status','requirement'])
            ->make(true);


        }

        $projectCount = Project::count();
        $projectCompleted = Project::where('status','completed')->count();
        $totalbudget = Project::sum('rate');
        $projects = Project::orderby('created_at','desc')->get();
        return view('admin.pages.project.project')
                ->with('projectCount',$projectCount)
                ->with('projectCompleted',$projectCompleted)
                ->with('totalbudget',$totalbudget)
                ->with('projects',$projects);

    }

    public function create()
    {
        $clients = Client::get();
        return view('admin.pages.project.project_add')->with('clients',$clients);
    }

    public function store(Request $request)
    {

        //dd( $request->all());
        $validate = $request->validate([
            'name' => 'required',
        ]);

        $project = New Project;
        $project->client_id = $request->client;
        $project->name = $request->name;
        $project->duration = $request->duration;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->requirement = $request->requirement;
        $project->description = $request->description;
        $project->rate = $request->rate;
        $project->price_type = $request->price_type;
        $project->priority = $request->priority;
        $project->status = $request->status;
        $project->notes = $request->notes;
        $project->completion_status = $request->completion_status;
        $project->save();

        $requirements = [];
        if($request->r_requirement){
            for($i=0; $i < count($request->r_requirement); $i++){
                if($request->r_requirement[$i] != null){
                    $input = Requirement::updateOrCreate([
                        //Add unique field combo to match here
                        //For example, perhaps you only want one entry per user:
                        'id'   => $request->p_id[$i]
                    ],[
                        'project_id'     => $project->id,
                        'requirement' => $request->r_requirement[$i],
                        'status'    => $request->r_status[$i],
                    ]);
                    array_push($requirements,$input->id);
                }
            }
        }
        $project->requirements()->sync($requirements);

        $payments = [];
        if($request->p_date){
            for($i=0; $i < count($request->p_date); $i++){
                if($request->p_date[$i] != null){
                    $input = Payment::updateOrCreate([
                        //Add unique field combo to match here
                        //For example, perhaps you only want one entry per user:
                        'id'   => $request->pm_id[$i]
                    ],[
                        'project_id'     => $project->id,
                        'date'     => $request->p_date[$i],
                        'amount' => $request->p_amount[$i],
                    ]);
                    array_push($payments,$input->id);
                }
            }
        }
        $project->payments()->sync($payments);


        return redirect()->route('project.index')
        ->with([
            'message'    =>'Project Added Successfully',
            'alert-type' => 'success',
        ]);

    }

    public function show($id)
    {
        $project = Project::findOrFail($id);

        //$sd = Carbon::createFromFormat('d-m-Y', $project->start_date);
        $stdt=Carbon::parse($project->start_date);
        $etdt=Carbon::parse($project->end_date);
        $nw = Carbon::parse(now());
        $days = ($nw->diffInDays($etdt));

        if($nw > $etdt){
            $days = 0;
        }


        //$dl = $ed - $nw;
        //dd($days);
        return view('admin.pages.project.project_view')->with('project',$project )->with('days',$days);
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $clients = Client::get();
        //return response()->json($project);

        return view('admin.pages.project.project_edit')->with('project',$project)->with('clients',$clients);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $validate = $request->validate([
            'name' => 'required',
        ]);

        $project = Project::findOrFail($id);
        $project->name = $request->name;
        $project->duration = $request->duration;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->requirement = $request->requirement;
        $project->description = $request->description;
        $project->rate = $request->rate;
        $project->price_type = $request->price_type;
        $project->priority = $request->priority;
        $project->status = $request->status;
        $project->notes = $request->notes;
        $project->payment = $request->payment;
        $project->completion_status = $request->completion_status;
        $project->save();

        $requirements = [];
        if($request->r_requirement){
            for($i=0; $i < count($request->r_requirement); $i++){
                if($request->r_requirement[$i] != null){
                    $input = Requirement::updateOrCreate([
                        //Add unique field combo to match here
                        //For example, perhaps you only want one entry per user:
                        'id'   => $request->p_id[$i]
                    ],[
                        'project_id'     => $project->id,
                        'requirement' => $request->r_requirement[$i],
                        'status'    => $request->r_status[$i],
                    ]);
                    array_push($requirements,$input->id);
                }
            }
        }
        $project->requirements()->sync($requirements);

        $payments = [];
        $payment_received=0;
        if($request->p_date){
            for($i=0; $i < count($request->p_date); $i++){
                if($request->p_date[$i] != null){
                    $input = Payment::updateOrCreate([
                        //Add unique field combo to match here
                        //For example, perhaps you only want one entry per user:
                        'id'   => $request->pm_id[$i]
                    ],[
                        'project_id'     => $project->id,
                        'date'     => $request->p_date[$i],
                        'amount' => $request->p_amount[$i],
                    ]);
                    $payment_received +=$request->p_amount[$i];
                    array_push($payments,$input->id);
                }
            }
        }
        $project->payments()->sync($payments);

        $project->payment_received = $payment_received;
        $project->save();

        //dd($payment_received);
        return redirect()->route('project.index')
        ->with([
            'message'    =>'Project Updated Successfully',
            'alert-type' => 'success',
        ]);


    }

    public function destroy($id)
    {
        $project = Project::destroy($id);

        if($project){
            return redirect()->route('project.index')
            ->with([
                'message'    =>'Project Updated Successfully',
                'alert-type' => 'success',
            ]);
        }else{

        }

    }

    public function project_quotation(Request $request){
        $project = Project::findOrFail($request->project);

        $to = 'amitvishwa19@gmail.com';
        $subject = 'Quotation for ' . $project->name ;
        $body = 'test body';
        $data = 'test data';
        $view = 'mails.quotation';

        

        try{
            $mail =  appmail($to,$subject,$body,$project,$view,true);
            return ['status' =>200,'msg'=>'Quotation mail sent successfully'];
        }catch(Exception $ex){
            return ['status' =>400,'msg'=>'Error while sending quotation mail'];
        }
        
        
        

        return $project;
        return 'Send Quotation';
        return view('admin.pages.project.quotation')->with('project',$project);
    }

    public function project_billing($id){
        $project = Project::findOrFail($id);

        return view('admin.pages.project.billing')->with('project',$project);
    }

    public function project_quotation_pdf($id){
        $project = Project::findOrFail($id);

        $data = array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            );
        $pdf = PDF::loadView('admin.pdf.quotation', $data);
        return $pdf->download('invoice.pdf');
        return view('admin.pdf.quotation')->with('project',$project);
    }
}
