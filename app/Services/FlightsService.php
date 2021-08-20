<?php


namespace App\Services;


class FlightsService
{
    /**
     * @param $flights
     * @return array
     */
    public function flightsGrouping(array $flights): array
    {
        $flightsAux = array();

        foreach ($flights as $key => $value) {
            if ($value['outbound']) {
                $flightsAux['outbound'][$value['fare']][$value['price']][] = $value;
            } else {
                $flightsAux['inbound'][$value['fare']][$value['price']][] = $value;
            }
        }

        $groupedFlights = $this->makeGroups($flightsAux);
        return $this->makeResponse($flights, $groupedFlights);
    }

    /**
     * @param array $flightsAux
     * @return array
     */
    private function makeGroups(array $flightsAux): array
    {
        $groups = array();

        foreach ($flightsAux['outbound'] as $keyO => $itemO) {
            foreach ($flightsAux['inbound'] as $keyI => $itemI) {
                if ($keyO == $keyI) {
                    foreach ($itemO as $o) {
                        foreach ($itemI as $i) {
                            $groups[] = ['outbound' => $o, 'inbound' => $i];
                        }
                    }
                }
            }
        }
        return $groups;
    }

    /**
     * @param array $flights
     * @param array $groupedFlights
     * @return array[]
     */
    private function makeResponse(array $flights, array $groupedFlights): array
    {

        return array(
            "flights" => $flights,
            "groups" => $groupedFlights
        );
    }

}
