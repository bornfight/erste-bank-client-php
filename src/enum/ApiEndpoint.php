<?php


namespace Bornfight\ErsteBankClient\enum;


class ApiEndpoint
{

    public const AISP_SANDBOX = "https://webapi.developers.erstegroup.com/api/ebc/sandbox/v1/psd2-aisp";
    public const NETAPI_SANDBOX = "https://webapi.developers.erstegroup.com/api/ebc/sandbox/v1/netapi";

    public const AUTH_SANDBOX = 'https://webapi.developers.erstegroup.com/api/ebc/sandbox/v1/sandbox-idp/auth';

    public const TOKEN_SANDBOX = 'https://webapi.developers.erstegroup.com/api/ebc/sandbox/v1/sandbox-idp';


    public const AISP_PROD = "https://webapi.developers.erstegroup.com/api/ebc/production/v1/psd2-aisp";
    public const NETAPI_PROD = "https://webapi.developers.erstegroup.com/api/ebc/production/v1/netapi";
    public const TOKEN_PROD = 'https://webapi.developers.erstegroup.com/api/ebc/production/v1/production-idp';
    public const AUTH_PROD = 'https://webapi.developers.erstegroup.com/api/ebc/production/v1/production-idp/auth';
}
