<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DetailPlan;
use App\Models\Plan;

use App\Http\Requests\StoreUpdateDetailPlan;

class DetailPlanController extends Controller
{
  protected $repository, $plan;

  public function __construct(Plan $plan, DetailPlan $detailPlan)
  {
		$this->plan 			= $plan;
    $this->repository = $detailPlan;
  }

  public function index($urlPlan)
  {
		if(!$plan = $this->plan->where('url', $urlPlan)->first()) {
			return redirect()->back();
		}

		// $details = $plan->details();
		$details = $plan->details()->paginate();
		return view('admin.pages.plans.details.index', [
			'plan' 		=> $plan,
			'details' => $details
		]);
  }

	public function create($urlPlan)
	{
		if(!$plan = $this->plan->where('url', $urlPlan)->first()) {
			return redirect()->back();
		}

		return view('admin.pages.plans.details.create', compact('plan'));
	}

	public function store(StoreUpdateDetailPlan $request, $urlPlan)
	{
		if(!$plan = $this->plan->where('url', $urlPlan)->first()) {
			return redirect()->back();
		}
		
		// $data = $request->all();
		// $data['plan_id'] = $plan->id;
		// $this->repository->create($data);
		$plan->details()->create($request->all());
		return redirect()->route('details.plan.index', $plan->url);
	}

	public function edit($urlPlan, $idDetail)
	{
		$plan 	= $this->plan->where('url', $urlPlan)->first();
		$detail = $this->repository->find($idDetail);

		if(!$plan || !$detail) {
			return redirect()->back();
		}

		return view('admin.pages.plans.details.edit', [
			'plan' 	 => $plan,
			'detail' => $detail
		]);
	}

	public function update(StoreUpdateDetailPlan $request, $urlPlan, $idDetail)
	{
		$plan 	= $this->plan->where('url', $urlPlan)->first();
		$detail = $this->repository->find($idDetail);

		if(!$plan || !$detail) {
			return redirect()->back();
		}

		$detail->update($request->all());
		return redirect()->route('details.plan.index', $plan->url);
	}

	public function show($urlPlan, $idDetail)
	{
		$plan 	= $this->plan->where('url', $urlPlan)->first();
		$detail = $this->repository->find($idDetail);

		if(!$plan || !$detail) {
			return redirect()->back();
		}

		return view('admin.pages.plans.details.show', [
			'plan' 	 => $plan,
			'detail' => $detail
		]);
	}

	public function destroy($urlPlan, $idDetail)
	{
		$plan 	= $this->plan->where('url', $urlPlan)->first();
		$detail = $this->repository->find($idDetail);

		if(!$plan || !$detail) {
			return redirect()->back();
		}

		$detail->delete();
		return redirect()	
							->route('details.plan.index', $plan->url)
							->with('messagem', 'Registro deletado com sucesso');
	}
}