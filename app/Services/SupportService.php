<?php

namespace App\Services;

use App\Models\Support;
use App\Services\BaseService;
use App\Forms\IForm;
use App\Services\EmailNotificationService;
use App\Services\ISupportService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;

/**
 * Class SupportService
 * @package App\Services
 */
class SupportService extends BaseService implements ISupportService
{

    /**
     * SupportService constructor.
     */
    public function __construct()
    {
        /** @var Support model */
        $this->model = new Support();

        parent::__construct();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function open($id)
    {
        $request = $this->model->find($id);
        $request->status = 0;
        $request->save();

        return $request;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function close($id)
    {
        $request = $this->model->find($id);
        $request->status = 1;
        $request->save();

        return $request;
    }


    /**
     * @param $name_en
     * @param $name_sp
     * @param $description_en
     * @param $description_sp
     * @param $clientEmail
     * @return Support
     */
    public function supportRequest($name_en, $name_sp, $description_en, $description_sp, $clientEmail): Support
    {
        $request = new Support();
        $request->name_en = $name_en;
        $request->name_sp = $name_sp;
        $request->description_en = $description_en;
        $request->description_sp = $description_sp;
        $request->client_email = $clientEmail;
        $request->status = ISupportService::OPEN_SUPPORT_REQUEST;
        $request->save();

        /* @var EmailNotificationService $mailService */

        $mailService = App::make(EmailNotificationService::class);
        $mailService->supportEmail($request);

        return $request;
        }
}
