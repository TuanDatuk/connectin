<?php

namespace App\Http\Controllers\Api\Client\Whatsapp;
use App\Models\Client;
use App\Models\Campaign;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Whatsapp\CampaignResource;
use App\Repositories\Client\WaCampaignRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    use ApiReturnFormatTrait;

    protected $campaign;

    public function __construct(WaCampaignRepository $campaign)
    {
        $this->campaign     = $campaign;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            $user                = jwtUser();
            $campaigns           = Campaign::where('client_id', $user->client_id)->where('campaign_type', 'whatsapp')->latest()->paginate(10);
            $client              = Client::where('id', $user->client_id)->first();
            $activeContactsCount = $client->contacts()->active()->count();

            $data                = [];

            foreach ($campaigns as $campaign) {
                $campaign_contact         = $campaign->total_contact ?? 0;
                $campaign_contact_percent = ($campaign_contact != 0) ? ($campaign_contact / $activeContactsCount) * 100 : 0;
                $total_delivered          = $campaign->total_delivered;
                $total_delivered_percent  = ($total_delivered != 0) ? ($total_delivered / $campaign_contact)     * 100 : 0;
                $total_read               = $campaign->total_read;
                $read_percent             = ($total_read != 0) ? ($total_read / $campaign_contact)               * 100 : 0;

                $data['campaigns'][]      = [
                    'campaign_contact'         => $campaign_contact,
                    'campaign_contact_percent' => $campaign_contact_percent,
                    'total_delivered_percent'  => $total_delivered_percent,
                    'total_read'               => $total_read,
                    'campaign'                 => new CampaignResource($campaign),
                ];
            }

            $data['paginate']    = [
                'total'         => $campaigns->total(),
                'current_page'  => $campaigns->currentPage(),
                'per_page'      => $campaigns->perPage(),
                'last_page'     => $campaigns->lastPage(),
                'prev_page_url' => $campaigns->previousPageUrl(),
                'next_page_url' => $campaigns->nextPageUrl(),
                'path'          => $campaigns->path(),
            ];

            return $this->responseWithSuccess(__('data_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'campaign_name'   => 'required|string',
            'template_id'     => 'required|exists:templates,id',
            'variables'       => 'nullable|string',
            'variables_match' => 'nullable|string',
            'url_link'        => 'nullable',
            'send_scheduled'  => 'nullable',
            'schedule_time'   => 'required_if:send_scheduled,1',
            'contact_list_id' => 'required',
            'segment_id'      => 'required',
        ]);

        if ($validator->fails()){
            return $this->responseWithError(__('validation_failed'), $validator->errors(), 422);
        }
        try {
            $user                 = jwtUser();
            $request['client_id'] = $user->client_id;
            $this->campaign->store($request);
            return $this->responseWithSuccess(__('created_successfully'));
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage(), [], 500);

        }
    }
}
