<?php

namespace App\Services;

use App\Models\Lead;
use App\Repositories\LeadRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LeadService
{
    protected $leadRepository;

    public function __construct(LeadRepository $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    public function getByAffiliateCode()
    {
        return $this->leadRepository->query()->where('affiliate_code', Auth::user()->affiliate_code)->paginate();
    }

    public function getByAffiliateCodePerPage($page)
    {
        return $this->leadRepository->query()->where('affiliate_code', Auth::user()->affiliate_code)->paginate(15, ['*'], 'page', $page);
    }

    public function getByAffiliateCodePerPageByRangeTime($rangeTime)
    {
        switch ($rangeTime) {
            case 'TODAY':
                return Lead::where('created_at', '>=', now()->format('Y-m-d 00:00:00'))->paginate(15);
            case 'YESTERDAY':
                return Lead::where('created_at', '>=', Carbon::yesterday()->format('Y-m-d H:i:s'))->where('created_at', '<', Carbon::today()->format('Y-m-d H:i:s'))->paginate(15);
            case 'THIS_WEEK':
                return Lead::where('created_at', '>=', now()->startOfWeek()->format('Y-m-d H:i:s'))->paginate(15);
            case 'THIS_MONTH':
                return Lead::where('created_at', '>=', now()->startOfMonth()->format('Y-m-d H:i:s'))->paginate(15);
            case 'LAST_MONTH':
                return Lead::where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d H:i:s'))
                    ->where('created_at', '<=', Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d H:i:s'))->paginate(15);
        }
    }

    public function getByAffiliateCodePerPagePickRangeTime($start, $end)
    {
        $start = Carbon::createFromTimestamp($start)->format('Y-m-d 00:00:00');
        $end = Carbon::createFromTimestamp($end)->format('Y-m-d 23:59:59');
        return Lead::where('created_at', '>=', $start)->where('created_at', '<=', $end)->paginate(15);
    }
}
