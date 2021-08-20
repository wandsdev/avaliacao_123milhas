<?php


namespace App\Services;


use Illuminate\Support\Str;

class FlightsService
{
    /**
     * @var int
     */
    public $cheapestPrice = 100000000000000000000000000000;

    /**
     * @var string
     */
    public $cheapestGroup = '';

    /**
     * @var array
     */
    public $groups = array();

    /**
     * @var array
     */
    public $flights = array();

    /**
     * @var
     */
    public $flightsAux = array();

    /**
     * @param $flights
     * @return array
     */
    public function flightsGrouping(array $flights): array
    {
        $this->flights = $flights;

        foreach ($flights as $key => $value) {
            if ($value['outbound']) {
                $this->flightsAux['outbound'][$value['fare']][$value['price']][] = $value;
            } else {
                $this->flightsAux['inbound'][$value['fare']][$value['price']][] = $value;
            }
        }

        $this->makeGroups();
        return $this->makeResponse();
    }

    private function makeGroups()
    {
        foreach ($this->flightsAux['outbound'] as $keyO => $itemO) {
            foreach ($this->flightsAux['inbound'] as $keyI => $itemI) {
                if ($keyO == $keyI) {
                    foreach ($itemO as $o) {
                        foreach ($itemI as $i) {
                            $uniqueId = $this->createUniqueIdgroup($o, $i);
                            $price = $o[0]['price'] + $i[0]['price'];
                            if ($this->cheapestPrice > $price) {
                                $this->cheapestPrice = $price;
                                $this->cheapestGroup = $uniqueId;
                            }
                            $this->groups[] = ['uniqueId' => $uniqueId, 'totalPrice' => $price, 'outbound' => $o, 'inbound' => $i];
                        }
                    }
                }
            }
        }
    }

    /**
     * @return array
     */
    private function makeResponse(): array
    {

        return array(
            "flights" => $this->flights,
            "groups" => $this->groups,
            "totalGroups" => count($this->groups),
            "totalFlights" => count($this->flights),
            "cheapestPrice" => $this->cheapestPrice,
            "cheapestGroup" => $this->cheapestGroup
        );
    }

    /**
     * @param $o
     * @param $i
     * @return string
     */
    private function createUniqueIdgroup($o, $i): string
    {
        $uniqueId = implode('', array_column($o, 'id'));
        $uniqueId .= implode('', array_column($o, 'flightNumber'));
        $uniqueId .= implode('', array_column($i, 'id'));
        $uniqueId .= implode('', array_column($i, 'flightNumber'));
        return base64_encode($uniqueId);
    }

}
