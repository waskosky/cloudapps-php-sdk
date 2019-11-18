<?php

namespace CloudPrinter\CloudApps\Action;

use CloudPrinter\CloudApps\Http\Response;

/**
 * Class ShippingAction
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class ShippingAction extends BaseAction
{
    /**
     * Get shipping levels.
     * @return Response
     */
    public function getLevels(): Response
    {
        $response = $this->httpClient->makeRequest('shipping/levels');

        return $response;
    }

    /**
     * Get shipping countries.
     * @return Response
     */
    public function getCountries(): Response
    {
        $response = $this->httpClient->makeRequest('shipping/countries');

        return $response;
    }

    /**
     * Get shipping states.
     * @param string $countryReference
     * @return Response
     */
    public function getStates(string $countryReference): Response
    {
        $data = ['country_reference' => $countryReference];
        $response = $this->httpClient->makeRequest('shipping/states', $data);

        return $response;
    }
}
