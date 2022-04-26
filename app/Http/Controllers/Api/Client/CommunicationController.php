<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Communication\CommunicationStore;
use App\Interfaces\EmailInterface;
use App\Mail\SendCommunication;


/**
 * @group Contact Us
 */
class CommunicationController extends Controller
{
    protected $emailInterface;

    public function __construct(EmailInterface $emailInterface) {
        $this->emailInterface = $emailInterface;
    }

    /**
     * Contact Us
     *
     * User Sends Info to a In Depth Agent
     *
     * @responseFile 200 scenario="success" responses/ok.json
     * @responseFile 422 scenario="invalid data passed" responses/unprocessable_entity.json
     */
    public function communicate(CommunicationStore $request)
    {
        $this->emailInterface->sendEmail(env("CUSTOMER_SERVICE_EMAIL"), SendCommunication::class, $request->validated());
        return ok_response();
    }
}
